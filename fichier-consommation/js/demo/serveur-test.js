const mysql = require('mysql');

const con = mysql.createConnection({
   host: "localhost",
   user: "root",
   password: "willy9105"
   database : "test2"
 });

  con.connect(function(err) {
   if (err) throw err;
   console.log("Connecté à la base de données MySQL!");
   con.query("SELECT NbFlash FROM test2", function (err, result) {
       if (err) throw err;
       console.log(result);
     });
 });



