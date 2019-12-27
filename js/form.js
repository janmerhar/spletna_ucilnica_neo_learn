/************************FUNKCIJE ZA DODAJANJE ELEMENTOV V UČILNICO************************/

function createInput(vrsta="text")
{
    let input = document.createElement("input")
    input.setAttribute("type", vrsta)
    input.setAttribute("required", "")

    let li = document.createElement("li")

    if(vrsta == "submit")
    {
        li.setAttribute("id", "ime_sklopa")
        input.setAttribute("value", "Potrdi")
        document.getElementById("ime_sklopa").appendChild(input)

    }
    else
    {
        let name = $("form ul li").length
        input.setAttribute("name", vrsta+name)
        input.setAttribute("placeholder", "Vnesite besedilo")
        
        if(vrsta == "picture")
        {
            input.setAttribute("accept", ".jpg, .jpeg, .gif, .png")
            input.setAttribute("type", "file")
        }

        let button = document.createElement("button")
        button.innerHTML = "-"
        button.setAttribute("name", vrsta+name)

        li.setAttribute("id", "l"+vrsta+name)
        
        document.getElementById("formul").appendChild(li)
        li.appendChild(input)
        li.appendChild(button)
        
        button.onclick = function(){
            this.parentNode.removeChild(this)
            input.parentNode.removeChild(input)
        }
    }

}

//Dodajanje polja, ki ima vrednost imena sklopa
function initialInput()
{
    let input = document.createElement("input")
    input.setAttribute("type", "text")
    input.setAttribute("name", "ime_sklopa")
    input.setAttribute("required", "")
    input.setAttribute("placeholder", "Vnesite ime sklopa")

    let li = document.createElement("li")
    li.setAttribute("id", "ime_sklopa")
    document.getElementById("formul").appendChild(li)
    li.appendChild(input)
}
/* klik na gumb ob polju za vnos podatkov*/
function onClickButton(attribute)
{
    //$("#iddiv").remove()
    createInput(attribute)
    //threeButtons()
}

/*funkcija, ki izriše tri gumbe za dodajanje novih polj*/
function threeButtons()
{
    let div = document.createElement("div");
    div.setAttribute("id", "iddiv")
    document.getElementById("formdiv").appendChild(div)

    let button1 = document.createElement("button")
    button1.innerHTML = "Besedilo"
    button1.setAttribute("id", "text")
    div.appendChild(button1)

    let button2 = document.createElement("button")
    button2.innerHTML = "Dokument"
    button2.setAttribute("id", "file")
    div.appendChild(button2)

    let button3 = document.createElement("button")
    button3.innerHTML = "Slika"
    button3.setAttribute("id", "picture")
    div.appendChild(button3)

    $("#text").click(function(e){
        e.preventDefault()
        onClickButton($("#text").attr('id'))
    })

    $("#file").click(function(e){
        e.preventDefault()
        onClickButton($("#file").attr('id'))
    })

    $("#picture").click(function(e){
        e.preventDefault()
        onClickButton("picture")
    })
    
}

/*funkcija, ki ustavari HTML element FORM ter ga postavi v DIV*/
function createForm()
{
    let form = document.createElement("form")
    form.setAttribute("name", "neki")
    form.setAttribute("action", "neki.php")
    form.setAttribute("id", "form")
    form.setAttribute("method", "post")
    //form.setAttribute("onsubmit", "checkFields(e)")

    document.getElementById("formdiv").appendChild(form)

    let ul = document.createElement("ul")
    ul.setAttribute("id", "formul")
    document.getElementsByTagName("form")[0].appendChild(ul)

    //Preprečim pošiljanje podatkov, če ni daodatnih polj poleg naslova sklopa
    $('#form').submit(function(e){
        if($('form input[type!=submit]').length <= 1)
        {
            alert("Ni dovolj podatkov za vnos!")
            e.preventDefault()
        }
    })
}

function mainFunction()
{
    createForm()
    initialInput()
    createInput("submit")
    threeButtons()
}
