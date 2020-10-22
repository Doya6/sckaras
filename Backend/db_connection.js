var mysql = require('rezervace');

var con = mysql.createConnection({
  host: "localhost",
  user: "mytestwwwtodecz",
  password: "H0ndaX11"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});