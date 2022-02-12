# CryingInBinary<br>
<h2>Contributors:</h2>
Alper Kandemir(Backend)<br>
Bora Fenari Köstem(Backend)<br>
Kylian Djermoune(Frontend)<br>
Nafissa El Moussaoui(Frontend)<br>
Oğulcan Karakollukçu(Backend)<br>



<h1>Backend</h1>
Fake database for student login information // Passwords and any other sensitive information should be stored in hashed forms.<br>
Admin, Doctor, Lab, Nurse and Student authority levels :<br>
Students can add their own health history (Xray or MR or older medications)<br>
Doctors can add their examinations about a student and it will show at students health history<br>
Admin can edit the current covid cases that will display on the site<br>
Admin can create new accounts for any other authority levels<br>
There can only be 1 Admin<br>
Tracking of old appointment<br>
Health History<br>
Create new Appointment (different categories)<br>
Diagnovir Test  <br>
Log login attempts <br>
On login student information (id, name, etc) will be pulled from database and written to JSON file (frontend will use information from this file // user.json) <br>



<h1>Frontend</h1>
Identification page (with COVID news, a need for blood donation, etc. Will be edited by admins)<br>
Visual Calendar for appointment<br>
Health History page with student infos<br>


<p><h3>Making an appointments:</h3>
    Appointment with specific doctor <br>
    Possibility to upload documents for the doctor <br>
    Seeing the doctor’s availability <br>
    Appointment confirmation by mail and reminder 24 h before </p>
