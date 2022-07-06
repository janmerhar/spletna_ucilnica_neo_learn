const mysql = require("mysql2")
const bcrypt = require("bcrypt")
const nodemailer = require("nodemailer")

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
  /*
    mailOptions: {
      name: "Ime Priimek",
      email: "",
      subject: "",
      text: "",
      html: ""
    }
  */

  static async sendEmail(mailOptions) {
    const testAccount = await nodemailer.createTestAccount()

    const transporter = nodemailer.createTransport({
      host: "smtp.ethereal.email",
      port: 587,
      secure: false, // true for 465, false for other ports
      auth: {
        user: testAccount.user, // generated ethereal user
        pass: testAccount.pass, // generated ethereal password
      },
    })

    const info = await transporter.sendMail({
      from: '"Učilnica Neo Learn" <learn.ucilnica@mail.com>',
      to: `"${mailOptions.name}" <${mailOptions.email}>`,
      subject: mailOptions.subject,
      text: mailOptions.text,
      html: mailOptions.html,
    })

    return info
    console.log("Message sent: %s", info.messageId)

    console.log("Preview URL: %s", nodemailer.getTestMessageUrl(info))
  }

  async sendCofirmationMail(formData) {
    const salt = bcrypt.genSaltSync()
    const hash = bcrypt.hashSync(formData.username, salt)

    const confirmationLink = `localhost/verify?vkey=${hash}`

    const mailOptions = {
      name: `${formData.ime} ${formData.priimek}`,
      email: formData.email1,
      subject: "Potrdite svoj uporabniški račun",
      text: `Spoštovani!\
      Hvala za registracijo pri spletni učilnici Learn. \
      Pred prvo prijavo morate potrditi svoj e-poštni naslov s klikom na povezavo.\
      `,
      html: `<p>Spoštovani!</p>\
      Hvala za registracijo pri spletni učilnici Learn. \
      Pred prvo prijavo morate potrditi svoj e-poštni naslov s klikom na \
      <a href="${confirmationLink}">  povezavo</a>.`,
    }

    const info = await User.sendEmail(mailOptions)

    console.log("Message sent: %s", info.messageId)

    console.log("Preview URL: %s", nodemailer.getTestMessageUrl(info))
    // Database update
  }

  async confirmRegistrationMail(confirmationLink) {}

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
userClass.sendCofirmationMail({
  username: "joseg",
  ime: "Joze",
  surname: "Gorisek",
  email1: "jose@gorisek.jbg",
})

// User.sendEmail({
//   name: "Janez Novak",
//   email: "myspdy@gmail.com",
//   subject: "Registracija na spletni učinlnici Neo Learn",
//   text: "Hello world?", // plain text body
//   html: "<b>Hello world?</b>", // html body
// })
