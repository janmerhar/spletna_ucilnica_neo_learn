function createInput(vrsta="text")
{
    let input = document.createElement("input")
    input.setAttribute("type", vrsta)

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
    input.setAttribute("type", "input")
    input.setAttribute("name", "ime_sklopa")

    let li = document.createElement("li")
    li.setAttribute("id", "ime_sklopa")
    document.getElementById("formul").appendChild(li)
    li.appendChild(input)
}

function onClickButton(attribute)
{
    //$("#iddiv").remove()
    createInput(attribute)
    //threeButtons()
}

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
        onClickButton("file")
    })
    
}

function createForm()
{
    let form = document.createElement("form")
    form.setAttribute("name", "neki")
    form.setAttribute("action", "get")
    form.setAttribute("id", "form")

    document.getElementById("formdiv").appendChild(form)

    let ul = document.createElement("ul")
    ul.setAttribute("id", "formul")
    document.getElementsByTagName("form")[0].appendChild(ul)
}

function mainFunction()
{
    createForm()
    initialInput()
    createInput("submit")
    threeButtons()

}