/*
 * MIT Amdocs Innovation Lab
 * Project: SAS - Short Advertisement Service

 * By:  Vipin Pillai
 *      Prajwal Kondawar
 *      Ajinkya Suryawanshi
 */




/* Standard C++ headers */
#include<cstdlib>
#include <iostream>
#include <sstream>
#include <memory>
#include <string.h>
#include <stdexcept>
#include <stdlib.h>
#include <stdio.h>


/* MySQL Connector/C++ specific headers */
#include <mysql_driver.h>
#include <mysql_connection.h>
#include <cppconn/statement.h>
#include <cppconn/prepared_statement.h>
#include <cppconn/resultset.h>
#include <cppconn/metadata.h>
#include <cppconn/resultset_metadata.h>
#include <cppconn/exception.h>
#include <cppconn/warning.h>
#include <cppconn/mysql/mysql.h>

#define DBHOST "tcp://127.0.0.1:3306"
#define USER "root"
#define PASSWORD "root"
#define DATABASE "Proj_db"

#define NUMOFFSET 100
#define COLNAME 200

using namespace std;
using namespace sql;


class keywords
{
private:
    char ip[110];
    char test[20][20];
    int test_count;
    double min_visited,min_total;
    char *keyword;

public:

    keywords()
    {
       test_count=0;
       min_visited=0;
       min_total=0;
       keyword=new char[15];
    }
    int lex(Statement *stmt);
    void find_minimum_conflict_waitcount(Statement *stmt);
    void append(Statement *stmt);
    void retrieve_and_printall(ResultSet *res);
};

int keywords::lex(Statement *stmt)  // Gives a set of relevant keywords.
{
    ResultSet *res;
    char temp[20]={"\0"};
    char qry[100];
    int len,i,j;

    cout<<"Enter SMS: ";
    gets(ip);
    len=strlen(ip);

    if(len>110)    // No action to be performed for msgs having length greater than 110.
        return 0;


   for(i=0,j=0;i<len;i++)
    {

       //Identify only characters from the SMS and ignore other symbols.
        if((ip[i] >= 'a'&& ip[i] <= 'z') || (ip[i] >= 'A'&& ip[i] <= 'Z'))
        {

            temp[j]=ip[i];
            j++;

            if((ip[i+1] < 'a' || ip[i+1] > 'z') && (ip[i+1] < 'A' || ip[i+1] > 'Z'))
            {
                temp[j]='\0'; //Store the relevant keyword
                strcpy(qry,"SELECT Keyword FROM Proj_db.Hash where Keyword= '");
                strcat(qry,temp);
                strcat(qry,"'");

                res = stmt -> executeQuery (qry);

                 if(res->next())
                 {
                   strcpy(test[test_count],temp);   // Maintain array of relevant keywords.
                   test_count++;
                 }
                    j=0;

            }
        }

    }

    cout<<"Keywords found in the given message: \n";
    for(i=0;i<test_count;i++)
        cout<<test[i]<<"\t";

   return((test_count>0)?1:0);

}

void keywords::find_minimum_conflict_waitcount(Statement *stmt){  // Fair ad selection

       ResultSet *res;
       double visited,total;
       double min_ratio=2,ratio;
       int wait_count,wait_count_prev,max_count=0;
       char *keyword_min;
       char qry[100];
       char temp[20],temp2[100];
       int i=0,flag=-1,update_count;

       keyword_min= new char[15];

        try{

            for(i=0;i<test_count;i++)
            {

            strcpy(temp2,"SELECT * FROM Proj_db.Hash where keyword = '");
            strcat(temp2,test[i]);
            strcat(temp2,"'");
            strcpy(qry,temp2);
            res = stmt -> executeQuery (qry);

            if(res->next())
            {
                    visited=(double)res->getUInt(2);
                    total=(double)res->getUInt(3);
                    wait_count=res->getUInt(4);
                    ratio=visited/total;

                    if(min_ratio>ratio)  // Keyword having minimum ratio(visited/total) is selected.
                        {
                            min_ratio=ratio;
                            min_visited=visited;
                            min_total=total;
                            strcpy(keyword_min,res->getString(1).c_str());
                            flag=1;
                        }

                        else if(min_ratio==ratio)  // Difference of total & visited decides the required keyword.
                        {
                            if((min_total-min_visited)<(total-visited))
                            {
                                min_ratio=ratio;
                                min_visited=visited;
                                min_total=total;
                                strcpy(keyword_min,res->getString(1).c_str());
                                flag=1;
                            }
                        }

                    if(visited==total)  // Keyword waits.
                    {
                        strcpy(keyword,res->getString(1).c_str());
                        wait_count++;
                        strcpy(qry,"UPDATE Proj_db.Hash SET Wait_count=");
                        sprintf(temp,"%d",wait_count);
                        strcat(qry,temp);
                        strcat(qry," WHERE Keyword = '");
                        strcat(qry,keyword);
                        strcat(qry,"'");
                        update_count = stmt->executeUpdate(qry);

                   }

              }

            } //end of outermost for loop.

              if(min_ratio==1)     // Selecting the most waited keyword.
                {
                    for(i=0;i<test_count;i++)
                    {
                        strcpy(temp2,"SELECT * FROM Proj_db.Hash where keyword = '");
                        strcat(temp2,test[i]);
                        strcat(temp2,"'");
                        strcpy(qry,temp2);
                        res = stmt -> executeQuery (qry);
                        if(res->next())
                        {
                            wait_count=res->getUInt(4);

                            if(wait_count>max_count)
                            {
                                max_count=wait_count;
                                min_visited=(double)res->getUInt(2);
                                min_total=(double)res->getUInt(3);
                                strcpy(keyword,res->getString(1).c_str());
                                flag=2;
                            }
                        }

                    }

                }

            if(flag==1)
                strcpy(keyword,keyword_min);


           } catch (SQLException &e) {
                    cout << "ERROR: SQLException in " << __FILE__;
                    cout << " (" << __func__<< ") on line " << __LINE__ << endl;
                    cout << "ERROR: " << e.what();
                    cout << " (MySQL error code: " << e.getErrorCode();
                    cout << ", SQLState: " << e.getSQLState() << ")" << endl;

                    if (e.getErrorCode() == 1045) {
                            /*
                            Error: 1047 SQLSTATE: 08S01 (ER_UNKNOWN_COM_ERROR)
                            Message: Unknown command
                            */
                          cout << "\nYour server does not seem to support Prepared Statements at all. ";
                            cout << "Perhaps MYSQL < 4.1?" << endl;
		}

	} catch (std::runtime_error &e) {

		cout << "ERROR: runtime_error in " << __FILE__;
		cout << " (" << __func__ << ") on line " << __LINE__ << endl;
		cout << "ERROR: " << e.what() << endl;

	}


}

void keywords :: append(Statement *stmt){  // Append selected ad to the SMS.

    ResultSet *res;
    int id;
    char *ad_string,qry[100];
    char *keyword_min;
    ad_string = new char[60];
    keyword_min= new char[15];
    char temp[20],temp2[100];
    int update_count,global_rating,current_rating,max_rating=-1,current_id,max_global_rating;
    int flag=-1,new_current_id;

    try{
             if(min_visited==min_total) // Forming circular linked list to select the first ad again.
            {
                strcpy(qry,"UPDATE Proj_db.Hash SET Visited_count=0 WHERE Keyword = '");
                strcat(qry,keyword);
                strcat(qry,"'");
                update_count = stmt->executeUpdate(qry);
                min_visited=0;
            }

            /*ADDED BY VIPIN ON 8/3/11*/

		
		strcpy(qry,"SELECT * FROM Proj_db.Ad_Node where Keyword= '");
                strcat(qry,keyword);
                strcat(qry,"'");

          	cout<<qry<<"\n";
	        res = stmt -> executeQuery (qry);

            while(res->next())
            {
                   
                    global_rating= res->getUInt(4);
                    current_rating= res->getUInt(5);
                                    
                   if(max_rating < current_rating)  // Keyword having maximum rating is selected.
                        {
                            max_rating = current_rating;
                            current_id = res->getUInt(1);
                            flag=1;
                        }
	      
	    
 	    } 
 	    

		if(flag==1)
		{ 
			if(max_rating==0)
			{
			
				strcpy(qry,"SELECT * FROM Proj_db.Ad_Node where Keyword= '");
				strcat(qry,keyword);
				strcat(qry,"'");

			  	cout<<qry<<"\n";
				res = stmt -> executeQuery (qry);

			        while(res->next())
			        {
				
					global_rating= res->getUInt(4);
					new_current_id = res->getUInt(1);
					strcpy(qry,"UPDATE Proj_db.Ad_Node SET Current_Rating=");
					sprintf(temp,"%d",global_rating);
					strcat(qry,temp);
					strcat(qry," WHERE Keyword = '");
					strcat(qry,keyword);
					strcat(qry,"' && id_Ad_Node = ");
					sprintf(temp,"%d",new_current_id);
					strcat(qry,temp);
					cout<<"\nQuery: "<<qry<<"\n";
					update_count = stmt->executeUpdate(qry);
					
					
					if(max_rating < global_rating)  // Keyword having maximum rating is selected.
						{
						    max_rating = global_rating;
						    current_id = new_current_id;
						}
					
					
		        	}
		        	
		        }
		       
				strcpy(qry,"UPDATE Proj_db.Ad_Node SET Current_Rating=");
				sprintf(temp,"%d",max_rating-1);
				strcat(qry,temp);
				strcat(qry," WHERE Keyword = '");
				strcat(qry,keyword);
				strcat(qry,"' && id_Ad_Node = ");
				sprintf(temp,"%d",current_id);
				strcat(qry,temp);
				update_count = stmt->executeUpdate(qry);
			
		}
           

        /*END OF BLOCK ADDED BY VIPIN ON 8/3/11*/

            strcpy(qry,"SELECT Ad_String FROM Proj_db.Ad_Node where Keyword = '");
            strcat(qry,keyword);
            strcat(qry,"' && id_Ad_Node =");
            sprintf(temp,"%d",current_id);
            strcat(qry,temp);
            res = stmt -> executeQuery (qry);
            res->next();


            strcpy(ad_string,res->getString(1).c_str());

            cout<<"\nThe original sms :";
            cout<<ip<<endl;
            cout<<"\nThe Ad-String selected is : ";
            cout<<ad_string<<endl;

            min_visited++;         // Next ad will be selected for furthur SMS.
            strcpy(qry,"UPDATE Proj_db.Hash SET Visited_count=");
            sprintf(temp,"%f",min_visited);

            strcat(qry,temp);

            strcat(qry," WHERE Keyword = '");
            strcat(qry,keyword);
            strcat(qry,"'");
            update_count = stmt->executeUpdate(qry);

            strcpy(qry,"UPDATE Proj_db.Hash SET Wait_count=0");
            strcat(qry," WHERE Keyword = '");
            strcat(qry,keyword);
            strcat(qry,"'");
            update_count = stmt->executeUpdate(qry);


       } catch (SQLException &e) {
		cout << "ERROR: SQLException in " << __FILE__;
                cout << " (" << __func__<< ") on line " << __LINE__ << endl;
		cout << "ERROR: " << e.what();
		cout << " (MySQL error code: " << e.getErrorCode();
		cout << ", SQLState: " << e.getSQLState() << ")" << endl;

		if (e.getErrorCode() == 1045) {
			/*
			Error: 1047 SQLSTATE: 08S01 (ER_UNKNOWN_COM_ERROR)
			Message: Unknown command
			*/
			cout << "\nYour server does not seem to support Prepared Statements at all. ";
			cout << "Perhaps MYSQL < 4.1?" << endl;
		}

	} catch (std::runtime_error &e) {

		cout << "ERROR: runtime_error in " << __FILE__;
		cout << " (" << __func__ << ") on line " << __LINE__ << endl;
		cout << "ERROR: " << e.what() << endl;

	}

}


void keywords::retrieve_and_printall(ResultSet *res)  // Display contents of the database.
{


    if (res -> rowsCount() == 0) {
		throw runtime_error("ResultSetMetaData FAILURE - no records in the result set");
	}

    ResultSetMetaData *res_meta = res -> getMetaData();
    int numcols = res_meta -> getColumnCount();

    cout << "Retrieving the results from Proj_db.Hash.." << endl;

    for(int i=0;i<numcols;i++)
    {
       cout << res_meta -> getColumnLabel(i+1)<<"\t\t";
    }
    cout<<endl<<endl;

    while(res->next())
    {
          cout<<res->getString(1).c_str()<<"\t\t\t";
          cout<<res->getUInt(2)<<"\t\t\t";
          cout<<res->getUInt(3)<<"\t\t\t";
          cout<<res->getUInt(4)<<endl;
          cout<<endl;

    }

}

int main(int argc, const char *argv[]) {

	Driver *driver;
	Connection *con;
	Statement *stmt;
	ResultSet *res;
	PreparedStatement *prep_stmt;

        int k=0;
        int updatecount = 0,count=-1;
        keywords key_obj;


	/* initiate url, user, password and database variables */
	string url(argc >= 2 ? argv[1] : DBHOST);
	const string user(argc >= 3 ? argv[2] : USER);
	const string password(argc >= 5 ? argv[3] : PASSWORD);
	const string database(argc >= 4 ? argv[4] : DATABASE);

	try {
		driver = get_driver_instance();

		/* create a database connection using the Driver */
 		con = driver -> connect(url, user, password);

		/* turn off the autocommit */
		con -> setAutoCommit(0);

		cout << "\nDatabase connection\'s autocommit mode = " << con -> getAutoCommit() << endl;

		/* select appropriate database schema */
		con -> setSchema(database);

		/* create a statement object */
		stmt = con -> createStatement();
                cout << "\nQuerying the Hash table to view contents .." << endl;

		/* re-use result set object */
		res = NULL;
		res = stmt -> executeQuery ("SELECT * FROM Proj_db.Hash");
                key_obj.retrieve_and_printall(res);

                k=key_obj.lex(stmt);   // Call to our tool.
                if(k)
                {
                    key_obj.find_minimum_conflict_waitcount(stmt);

                    key_obj.append(stmt);

                }
                con -> commit();


      		cout << "\nQuerying the Hash table to view contents .." << endl;

		/* re-use result set object */
		res = NULL;
		res = stmt -> executeQuery ("SELECT * FROM Proj_db.Hash");
                key_obj.retrieve_and_printall(res);

		cout << "Cleaning up the resources .." << endl;

		/* Clean up resources*/

		delete stmt;
		con -> close();
		delete con;

	} catch (SQLException &e) {
		cout << "ERROR: SQLException in " << __FILE__;
                cout << " (" << __func__<< ") on line " << __LINE__ << endl;
		cout << "ERROR: " << e.what();
		cout << " (MySQL error code: " << e.getErrorCode();
		cout << ", SQLState: " << e.getSQLState() << ")" << endl;

		if (e.getErrorCode() == 1045) {
			/*
			Error: 1047 SQLSTATE: 08S01 (ER_UNKNOWN_COM_ERROR)
			Message: Unknown command
			*/
			cout << "\nYour server does not seem to support Prepared Statements at all. ";
			cout << "Perhaps MYSQL < 4.1?" << endl;
		}

		return 1;
	} catch (std::runtime_error &e) {

		cout << "ERROR: runtime_error in " << __FILE__;
		cout << " (" << __func__ << ") on line " << __LINE__ << endl;
		cout << "ERROR: " << e.what() << endl;

		return 1;
	}

	return 0;
}
