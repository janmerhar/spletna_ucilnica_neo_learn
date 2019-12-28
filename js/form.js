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

    document.getElementById("formdiv").appendChild(form)

    let ul = document.createElement("ul")
    ul.setAttribute("id", "formul")
    document.getElementsByTagName("form")[0].appendChild(ul)

    //Preprečim pošiljanje podatkov, če ni dodatnih polj poleg naslova sklopa
    $('#form').submit(function(e){
        if($('form input[type!=submit]').length <= 1)
        {
            alert("Ni dovolj podatkov za vnos!")
            e.preventDefault()
        }
    })
}

//dodajanje FORM-e v že narejeni sklop 
function insideForm(n)
{
    let form = document.createElement("form")
    form.setAttribute("name", "f"+n)
    form.setAttribute("method", "post")
    //mogoče naredim, da kliče drugo datoteko za vnos naknadnih podatkov

    document.getElementById(n).appendChild(form)

    let submit = document.createElement("input")
    submit.setAttribute("type", "submit")
    submit.setAttribute("value", "Potrdi")

    form.appendChild(submit)

    let ul = document.createElement("ul")
    ul.setAttribute("id", "ul"+n)
    form.appendChild(ul)

}


function insideCreateInput(vrsta, n)
{

    let input = document.createElement("input")
    input.setAttribute("type", vrsta)
    input.setAttribute("required", "")

    let li = document.createElement("li")
    let name = $("#f"+n+" ul li").length

    input.setAttribute("name", n+vrsta+name)
    input.setAttribute("placeholder", "Vnesite besedilo")
    
    if(vrsta == "picture")
    {
        input.setAttribute("accept", ".jpg, .jpeg, .gif, .png")
        input.setAttribute("type", "file")
    }

    let button = document.createElement("button")
    button.innerHTML = "-"
    
    li.appendChild(input)
    li.appendChild(button)
    document.getElementById("ul"+n).appendChild(li)
    
    button.onclick = function(){
        li.parentNode.removeChild(li)
    }
}

//preveri, če potrebujem e.preventDefault 
function insideThreeButtons(n)
{
    let div = document.createElement("div");
    div.setAttribute("id", "div"+n)
    div.innerHTML = "vsebina DIV-a za tesitranje"
    document.getElementById(n).appendChild(div)

    let button1 = document.createElement("button")
    button1.innerHTML = "Besedilo"
    div.appendChild(button1)

    button1.onclick = function(){
        insideCreateInput("text", n)
    }

    let button2 = document.createElement("button")
    button2.innerHTML = "Dokument"
    div.appendChild(button2)

    button2.onclick = function(){
        insideCreateInput("file", n)
    }

    let button3 = document.createElement("button")
    button3.innerHTML = "Slika"
    div.appendChild(button3)

    button3.onclick = function(){
        insideCreateInput("picture", n)
    }
    
    div.appendChild(button1)
    div.appendChild(button2)
    div.appendChild(button3)

}

//Funkcija, ki doda gumbe za izbris sklopov in njihovih elementov insideMAIN()
function deleteSklop()
{
    $(".vsebina_sklopa").each(function(){
        //i je zap. št. sklopa
        //n je zap št. elementa v sklopu
        let i = 1;
        //DB določi id sklopa
        let n = $(this).attr("id")
        //$(this).find("p").append(" && Krneki")

        //gumb za izbris sklopa
        let button = document.createElement("button")
        button.innerHTML = "-"
        button.setAttribute("id", n)
        this.getElementsByTagName("p")[0].appendChild(button)

        button.onclick = function(){
            document.getElementById(n).remove()
            //dodaj AJAX za brisanje sklopa
        }

        //gumb za dodajanje elementov
        let button2 = document.createElement("button")
        button2.innerHTML = "+"
        button2.setAttribute("id", "+"+n)
        this.getElementsByTagName("p")[0].appendChild(button2)

        //dodam FORM element in gumbe, s katerimi dodajam polja
        button2.onclick = function(){
            this.parentNode.removeChild(this)
            insideForm(n)
            insideThreeButtons(n)
        }

        $(this).find("li").each(function(){{
            $(this).attr("id", n+'.'+i)
            let button = document.createElement("button")
            button.innerHTML = "-"
            button.setAttribute("id", "del"+n+'.'+i)
            this.appendChild(button)

            button.onclick = function(){
                this.parentNode.remove(this)
                
                //dodaj AJAX za brisanje elemta sklopa 
            }

            i++;
        }})
    })
}

function mainFunction()
{
    createForm()
    initialInput()
    createInput("submit")
    threeButtons()
    //dodajanje gumbov za brisanje sklopo in njihovih elementov
    deleteSklop()
}
