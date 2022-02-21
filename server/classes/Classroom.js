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
        `SELECT imeucilnice, vrsta_ucilnice, kljuc, kategorija_imekategorije FROM ucilnica WHERE lower(imeucilnice) LIKE ? ORDER BY imeucilnice`,
        [`%${searchQuery}%`]
      )

    return rows
  }
}

const classroom = new Classroom(connection)
classroom
  .getSearchClassrooms("test")
  .then((res) => {
    console.log(res)
  })
  .catch((err) => {
    console.log(err)
  })
