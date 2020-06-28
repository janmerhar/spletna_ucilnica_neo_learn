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
        onClickButton("picture")
    })
    
}

function createForm()
{
    let form = document.createElement("form")
    form.setAttribute("action", "php/insert_sklop.php")
    form.setAttribute("id", "form")
    form.setAttribute("enctype", "multipart/form-data")
    form.setAttribute("method", "post")
    form.setAttribute("class", "form")

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
    form.setAttribute("enctype", "multipart/form-data")
    form.setAttribute("name", "f"+n)
    form.setAttribute("method", "post")
    form.setAttribute("class", "form")
    //mogoče naredim, da kliče drugo datoteko za vnos naknadnih podatkov

    document.getElementById(n).appendChild(form)

    let submit = document.createElement("input")
    submit.setAttribute("type", "submit")
    submit.setAttribute("value", "Potrdi")

    submit.onclick = function(e){
        //preveri, če je ul prazen
        if(document.getElementsByName("f"+n)[0].elements.length <= 1)
        {
            //console.log(document.getElementsByName("f"+n)[0].elements.length)
            e.preventDefault()
            alert("Ni dovolj podatkov za vnos!")
        }
    }

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
        input.setAttribute("accept", "image/*")
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

function insideThreeButtons(n)
{
    let div = document.createElement("div");
    div.setAttribute("id", "div"+n)
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

        //gumb za izbris sklopa
        let button = document.createElement("button")
        button.innerHTML = "-"
        button.setAttribute("id", n)
        this.getElementsByTagName("p")[0].appendChild(button)

        var sklop = n
        button.onclick = function(){
            // $(".vsebina_sklopa#"+n).remove()
            /* spreminjam na ajax
            window.open("php/ajax.php?sklop="+sklop, "_self")
            */
           const xhr = new XMLHttpRequest()
           xhr.open("POST", "php/ajax.php")
           xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

           xhr.onreadystatechange = () => {
            if(xhr.readyState == 4 && xhr.status == 200)
                if(xhr.responseText == "true")
                {
                    document.getElementById(n).remove()
                }
           }

           xhr.send("sklop="+sklop)
        }

        // gumb na vsakem LI elementu sklopa
        $(this).find("li").each(function(){{
            // spremeni id in sklop cifri iz  
            let liid = $(this).attr('id')

            // iz LIID izvlečem dve številki
            let sklop1 = liid.substring(0, liid.indexOf("."))
            let idsklopa = liid.substring(liid.indexOf(".")+1)

            let button = document.createElement("button")
            button.innerHTML = "-"
            //button.setAttribute("id", "del"+n+'.'+i)
            this.appendChild(button)

            var sklop = n
            var id = i
            button.onclick = function(){
                // window.open("php/ajax.php?id="+idsklopa+"&sklop="+sklop1, "_self")
                const xhr = new XMLHttpRequest()
                xhr.open("POST", "php/ajax.php")
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")

                xhr.onreadystatechange = () => {
                    if(xhr.readyState == 4 && xhr.status == 200)
                    {
                        if(xhr.responseText == "true")
                        {
                            document.getElementById(liid).remove()
                        }
                    }
                }

                xhr.send("id="+idsklopa+"&sklop="+sklop1)
            }
             
            i++;
        }})
        
    })
}

//Funkcija, ki preverja enakost polj za vnos gesla
function registerForm()
{
    $("form").submit(function(e){
        let geslo1 = document.getElementsByName("geslo")[0]
        let geslo2 = document.getElementsByName("geslo2")[0]
        
        let email1 = document.getElementsByName("email1")[0]
        let email2 = document.getElementsByName("email2")[0]
        
        if(email1.value != email2.value)
        {
            e.preventDefault();
            $("input[name='email1']").css("border", "1px solid red")
            $("input[name='email2']").css("border", "1px solid red")
        }
        if(geslo1.value != geslo2.value)
        {
            e.preventDefault();
            $("input[name='geslo']").css("border", "1px solid red")
            $("input[name='geslo2']").css("border", "1px solid red")
        }
    })
}

//Dodam polje za geslo, ko uporabnik pritisne gumb DA za zasebno učilnico createucilnica.php
function dodajPoljeGeslo2()
{
    //Pridobim polji za izbiro zasebnosti učilnice
    let da = document.getElementsByName("zaseben")[0]
    let ne = document.getElementsByName("zaseben")[1]

    //Pridobim polje za vnos gesla
    let submit = document.getElementById("pass")

    //Spremenim vidnost polja za geslo glede na vrednost za zasebnost učilnice 
    if(da.checked == false)
    {
        $("#pass").hide()
        $("#pass").removeAttr("required")
    }
    else
    {
        $("#pass").show()
        $("#pass").attr("required", "")
    }
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

/************************ Funkcije za vnos testov ********************/
function dodajGumb()
{
    let div = document.getElementsByName("vnos")
    for(let i = 0; i < div.length; i++)
    {
        let li = div[i].getElementsByTagName("li")
        for(let j = 0; j < li.length; j++)
        {
            let button = document.createElement("button")
            button.innerHTML = " - "
            li[j].appendChild(button)

            button.onclick = function(){
                if(li.length == 1)
                    div[i].remove()
                else
                    li[j].remove()
            }
        }
        let buttonDodaj = document.createElement("button")
        let liDodaj = document.createElement("li")

    }
} 

function narediVnosFormo()
{
    let form = document.createElement("form")
    form.setAttribute("method", "post")
    form.setAttribute("action", "")
    
    document.getElementById("vnosForm").appendChild(form)

    let ul = document.createElement("ul")
    form.appendChild(ul)
}

function dodajGumbZaPolja(id)
{
    let button = document.createElement("button")
    button.innerHTML = "Dodaj vnosno polje"
    let div = document.getElementById(id)

    let li = document.createElement("li")
    let lis = div.getElementsByTagName("li");
    let n = div.getAttribute("id")+"."+(lis.length+1)
    
    div.appendChild(button)
}

function prviSklop()
{
    let div = document.createElement("div")
    div.setAttribute("id", "1")
    div.setAttribute("name", "vnos")
    let ul = document.getElementById("vnosul")

    ul.appendChild(div)
}

function dodajSklop()
{
    //novi sklop
    let div = document.createElement("div")
    //forma, v kateri se sklopi nahajajo
    let form = document.getElementsByTagName("form")[0]
    //ul, na katerega dodajamo elemente
    let ul = document.getElementById("vnosul")

    let divs = document.getElementsByName("vnos")
    let number = divs.length+1
    //nastavljanje atributov
    div.setAttribute("id", number)
    div.setAttribute("name", "vnos")

    ul.appendChild(div)
}

//gumbi na vrhu strani za podatke o samem testu: ime, trajanje, število vprašanj, gumb
function headerGumbi()
{
    let form = document.getElementsByTagName("form")[0]

    let imetesta = document.createElement("input")
    imetesta.setAttribute("type", "text")
    imetesta.setAttribute("name", "ime")
    imetesta.setAttribute("placeholder", "Ime testa")
    imetesta.setAttribute("required", "")
    imetesta.setAttribute("pattern", "[a-žA-Ž0-9 ]+")
    form.appendChild(imetesta)

    let stvprasanj = document.createElement("input") 
    stvprasanj.setAttribute("type", "number")
    stvprasanj.setAttribute("placeholder", "Število vprašanj na testu")
    stvprasanj.setAttribute("required", "")
    stvprasanj.setAttribute("min", "1")
    stvprasanj.setAttribute("step", "1")
    stvprasanj.setAttribute("name", "stvprasanj")
    form.appendChild(stvprasanj)

    let trajanje = document.createElement("input") 
    trajanje.setAttribute("type", "number")
    trajanje.setAttribute("name", "trajanje")
    trajanje.setAttribute("placeholder", "Trajanje testa")
    trajanje.setAttribute("required", "")
    trajanje.setAttribute("min", "1")
    trajanje.setAttribute("step", "1")
    form.appendChild(trajanje)

    let potrdi = document.createElement("input") 
    potrdi.setAttribute("type", "submit")
    potrdi.setAttribute("value", "Potrdi vnos")

    form.appendChild(potrdi)
}

//pridobim ime zadnjega LI elementa v UL
function najdiZadnjiInput(ul)
{
    let li = ul.getElementsByTagName("li")
    if(li.length <= 0)
        return 1;
    let lastId = li[li.length-1].getAttribute("id")
    let n = lastId.substring(lastId.indexOf(".")+1, lastId.length)
    n = parseInt(n)+1
    return n;
}   


function dodajOdgovor(ul, n)
{
    let li = document.createElement("li")
    let ulN = najdiZadnjiInput(ul)
    li.setAttribute("id", n+"."+ulN)
    
    let odgovorN = najdiZadnjiInput(ul)

    let odgovor = document.createElement("input")

    odgovor.setAttribute("type", "text")
    odgovor.setAttribute("name", "odg"+n+"."+odgovorN)
    odgovor.setAttribute("required", "")
    odgovor.setAttribute("placeholder", "Odgovor"+odgovorN)

    ul.appendChild(li)
    li.appendChild(odgovor)

    //gumba za označevanje pravilnosti odgovora
    let da = document.createElement("input")
    da.setAttribute("type", "radio")
    da.setAttribute("name", "radio"+n+"."+odgovorN)
    da.setAttribute("required", "")
    da.setAttribute("value", "ja")
    li.append("DA")
    li.appendChild(da)

    let ne = document.createElement("input")
    ne.setAttribute("type", "radio")
    ne.setAttribute("name", "radio"+n+"."+odgovorN)
    ne.setAttribute("required", "")
    ne.setAttribute("value", "ne")
    li.append("NE")
    li.appendChild(ne)

    let odstrani = document.createElement("button")
    odstrani.innerHTML = " - "
    
    li.appendChild(odstrani)
    odstrani.onclick = function(){
        this.parentNode.remove()
    }
}

function dodajUl()
{
    let form = document.getElementsByTagName("form")[0]
    let n = form.getElementsByTagName("ul").length

    //dodelim ID za UL in ga dodam v FORM
    n = n + 1;
    let ul = document.createElement("ul")
    ul.setAttribute("id", n)
    form.appendChild(ul)

    //naredim vnosno polje za VPRAŠANJE
    let vprasanje = document.createElement("input")
    vprasanje.setAttribute("type", "text")
    vprasanje.setAttribute("name", "vprasanje"+n)
    vprasanje.setAttribute("required", "")
    vprasanje.setAttribute("placeholder", "Vprašanje"+n)
    ul.appendChild(vprasanje)

    //naredim LI za UL
    dodajOdgovor(ul, n)
    dodajOdgovor(ul, n)

    //Gumb, ki bo dodajal polja za vnos odgovorov
    let button = document.createElement("button")
    button.innerHTML = "Dodaj odgovor"

    ul.appendChild(button)
    
    button.onclick = function(e){
        e.preventDefault()
        dodajOdgovor(ul, n)
        button.remove()
        ul.appendChild(button)
    }
}

function gumbZaUl()
{
    let div = document.getElementById("vnosForm")
    let button = document.createElement("button")
    button.innerHTML = "Dodaj vprašanje"

    div.appendChild(button)
    button.onclick = function(){ 
        dodajUl()
    }
}

function vnosTesta()
{
    let form = document.getElementsByTagName("form")[0]

    headerGumbi()
    dodajUl()
    gumbZaUl()
}


function countdown(minutes) 
{
let seconds = 60
let mins = minutes
    function tick() 
    {
    let counter = document.getElementById("countdown")
    let current_minutes = mins-1
        seconds--
        counter.innerHTML = current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds)
        if(seconds > 0) 
        {
            setTimeout(tick, 1000)
        } 
        else if(mins > 1) 
        {
            countdown(mins-1);          
        }
        // koda za FORM SUBMIT, ko se čas izteče
        else
        {
            let form = document.getElementsByTagName("form")[0]
            form.submit()
        }
    }
    tick()
}
