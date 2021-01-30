<pre>
<strong>Graduate</strong> is a course project, for helping the graduation process both for students and administration.
It has three main roles: students, administration and supervisors for gowns/hats/diplomas/signs.
<br>

<strong> Role: student </strong>
Students can declare that they will attend their ceremony by clicking the button on their attendance page, 
after clicking it the system will generate a number that tells them the order and approximately the time in which 
the student will be called to receive their  diploma . The system will also monitor the status of the individual 
tasks that student needs to finish. 
(taking / returning togas / hats, taking a diploma and signing for a diploma) before taking their diploma.

<strong> Role:  supervisors </strong>
These are the users who are responsible for handing out gowns / hats / diplomas and checking whether or not the student 
has signed that they have received their diploma. For each supervisor in charge there is a page that is identical 
to that of the others.  When changing the status of a task (for example, a student has taken a hat), the person 
in charge can  write a comment about the condition of the item/s taken 
(usually to write if there is a problem with the hat), and the system records: who made the change to the state 
of the student's hat and others and when, also to save the comment. 

<strong> Role: Administration</strong>
Administration can create ceremonies for awarding diplomas, en-roll students to said ceremonies 
(by csv file or manual). Administration can also change the date of the ceremony , reorder student order for receiving 
diploma, export csv file with the current status of the task(received diplomas/hats/gowns and signs for a ceremony)
<br>
<strong>Db scripts</strong>
SQL_CreateDB.txt contains the code for the db and inserts SQL_Insert.txt contains sample data.
To log in as an admin type for username and password: admin.
The supervisors for hats can use “Hat” for username and password, the supervisors for diplomas can use “Diploma” 
username and password, and so on. To log as a student check the inserts.
<br>
StudentData.csv contains sample data for enrolling students with csv file.


</pre>
