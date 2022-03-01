const mysql = require("mysql2")

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  database: "learn",
})

class Classroom {
  constructor(connection) {
    this.connection = connection
  }

  // Classroom printout functions
  async getAllClassrooms() {
    const [rows, fields] = await connection
      .promise()
      .execute(
        "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije \
        FROM ucilnica ORDER BY imeucilnice LIMIT 10"
      )

    return rows
  }

  async getUserClassrooms(username) {
    const [rows, fields] = await connection
      .promise()
      .execute(
        "SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije \
        FROM ucilnica u INNER JOIN vclanjen v ON u.imeucilnice = v.ucilnica_imeucilnice \
        WHERE uporabnik_upime = ? ORDER BY imeucilnice ",
        [username]
      )

    return rows
  }

  async getSearchClassrooms(searchQuery) {
    const [rows, fields] = await connection
      .promise()
      .execute(
        `SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije FROM ucilnica WHERE lower(imeucilnice) LIKE lower(?) ORDER BY imeucilnice`,
        [`%${searchQuery}%`]
      )

    return rows
  }

  // Function for category printout
  async getAllCategories() {
    const [rows, fields] = await connection
      .promise()
      .execute("SELECT imekategorije FROM kategorija")

    return rows
  }

  // Classroom member functions
  // Will need to change format that fits the on in vclanjeniuporabniki.php
  async getAllMembers(classroom) {
    const [rows, fields] = await connection
      .promise()
      .execute(
        "SELECT ime, priimek, upime, vrsta_clanstva FROM \
        uporabnik u INNER JOIN vclanjen v ON u.upime = v.uporabnik_upime \
        INNER JOIN ucilnica uc ON uc.imeucilnice = v.ucilnica_imeucilnice \
        WHERE imeucilnice = ? \
        ORDER BY vrsta_clanstva, priimek, ime, upime",
        [classroom]
      )

    return rows
  }

  async getMemberStatus(queryData) {
    const [rows, fields] = await connection
      .promise()
      .execute(
        "SELECT vrsta_clanstva \
        FROM vclanjen \
        WHERE uporabnik_upime = ? AND ucilnica_imeucilnice = ?",
        [queryData.username, queryData.classroom]
      )

    return rows
  }

  async removeMemberFromClassroom(queryData) {
    const [rows, fields] = await connection
      .promise()
      .execute(
        "DELETE FROM vclanjen \
        WHERE uporabnik_upime = ? AND ucilnica_imeucilnice = ?",
        [queryData.username, queryData.classroom]
      )

    return rows
  }

  async addMemberToClassroom(queryData) {
    const [rows, fields] = await connection
      .promise()
      .execute("INSERT INTO vclanjen \
            VALUES(?, ?, ?)", [
        queryData.imeUcilnice,
        queryData.username,
        "admin",
      ])

    return rows
  }

  // Function for creating a new classroom
  async createClassroom(classroomData) {
    const kljuc =
      classroomData.isJavna != "zasebna" ? classroomData.geslo : "NULL"

    // Inserting classroom name into table UCILNICA
    const [rows, fields] = await connection.promise().execute(
      "INSERT INTO ucilnica \
        VALUES(?, ?, ?, ?)",
      [
        classroomData.imeUcilnice,
        classroomData.isJavna,
        kljuc,
        classroomData.kategorija,
      ]
      // VALUES('$imeucilnice', '$vrsta_ucilnice', '$kljuc', '$kategorija')"
    )

    //
  }
}

const classroom = new Classroom(connection)
classroom
  .removeMemberFromClassroom({
    username: "franch",
    classroom: "Ucilnica z vsebino",
  })
  .then((res) => {
    console.log(res)
  })
  .catch((err) => {
    console.log(err)
  })
