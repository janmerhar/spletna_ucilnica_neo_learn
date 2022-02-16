const mysql = require("mysql2")
const bcrypt = require("bcrypt")

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  database: "learn",
})

// connection.query("SELECT * FROM uporabnik", (err, results, fields) => {
//   if (err) {
//     console.log(err)
//     return
//   }
//   console.log(results)
// })

// connection.close()

// connection
//   .promise()
//   .execute("SELECT * FROM uporabnik")
//   .then(([rows, fields]) => console.log(rows, fields))
//   .catch((err) => console.log(err))

class User {
  constructor(connection) {
    this.connection = connection
  }

  async queryUser(username) {
    const [rows, fields] = await connection
      .promise()
      .execute("SELECT hash, email, vkey FROM uporabnik WHERE upime = ?", [
        username.toLowerCase(),
      ])
    return rows
  }

  async verifyUserLogin(username, password) {
    const [rows, fields] = await queryUser(username)
    return bcrypt(password, rows[0].hash)
  }

  // async loginUser
  /*
  formData: {
    username: "",
    ime: "",
    priimek: "",
    email1: "",
    email2: "",
    password1: "",
    password2: "",
  }
  */
  async registerUser(formData) {
    const salt = bcrypt.genSaltSync()
    const hash = bcrypt.hashSync(formData.username, salt)
    if (
      formData.email1 === formData.email2 &&
      formData.password1 === formData.password2
    ) {
      const [rows, fields] = await connection
        .promise()
        .execute(
          "INSERT INTO uporabnik(upime, ime, priimek, email, vkey, hash) VALUES(?, ?, ?, ?, ?, ?)",
          [
            formData.username,
            formData.ime,
            formData.priimek,
            formData.email1,
            "NONVALUE",
            hash,
          ]
        )
      return rows
    }
    // else error is thrown
    // Need to send an email to user
  }
}

const userClass = new User(connection)
userClass
  .registerUser({
    username: "lilJose",
    ime: "Jose",
    priimek: "Horisek",
    email1: "1@v.com",
    email2: "1@v.com",
    password1: "123",
    password2: "123",
  })
  .then((res) => {
    console.log(res)
  })
  .catch((err) => {
    console.log(err)
  })
