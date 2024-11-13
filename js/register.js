function Reset()
{
    document.getElementById("ime").value="";
    document.getElementById("prezime").value="";
    document.getElementById("email").value="";
    document.getElementById("sifra").value="";
}

// function Provera()
// {
//     //Dodela vrednosti iz polja
//     var ime = document.getElementById("ime").value;
//     var prezime = document.getElementById("prezime").value;
//     var email = document.getElementById("email").value;
//     var sifra = document.getElementById("sifra").value;
    
//     //Provera praznog polja
//     if(ime=="" || prezime=="" || email=="" || sifra=="")
//     {
//         document.getElementById("greskaPrazno").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Morate popuniti sva polja za unos!";
//     }
//     else
//     {
//         document.getElementById("greskaPrazno").innerHTML = "";
        
//         //Regex
//         //ime,prezime
//         var imeprezimePatter = /^[A-Z]{1}[a-z]{2,}$/g
//         //email
//         var emailPatter = /^.{2,32}[@]{1}[a-z0-9]{3,16}[.]{1}[a-z]{2,6}$/g
//         //sifra
//         var sifraPatter = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,16}$/g

//         if(ime.match(imeprezimePatter)==null || prezime.match(imeprezimePatter)==null || email.match(emailPatter)==null || sifra.match(sifraPatter)==null)
//         {
//             document.getElementById("greskaIme").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Greška!" + "<p id='opis'>-Početno slovo mora biti veliko! <br>-Ime mora imati minimum 3 slova</p>";
//             if(ime.match(imeprezimePatter)!=null)
//             {
//                 document.getElementById("greskaIme").innerHTML = "";
//             }

//             document.getElementById("greskaPrezime").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Greška!"+ "<p id='opis'>-Početno slovo mora biti veliko! <br>-Prezime mora imati minimum 3 slova</p>";
//             if(prezime.match(imeprezimePatter)!=null)
//             {
//                 document.getElementById("greskaPrezime").innerHTML = "";
//             }

//             document.getElementById("greskaEmail").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Neispravan format e-mail adrese!" + "<p id='opis'>Primer: john.doe@example.com </p>";
//             if(email.match(emailPatter)!=null)
//             {
//                 document.getElementById("greskaEmail").innerHTML = "";
//             }

//             document.getElementById("greskaSifra").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Neispravan unos šifre" + "<p id='opis'>Šifra mora imati:<br>-Min. 8 karatkera <br>-Max. 16 karatkera <br>-Bar jedno veliko slovo <br>-Bar jedno malo slovo <br>-Bar jedan broj </p>";
//             if(sifra.match(sifraPatter)!=null)
//             {
//                 document.getElementById("greskaSifra").innerHTML = "";
//             }
//         }
//         else if(ime.match(imeprezimePatter)!=null || prezime.match(imeprezimePatter)!=null || email.match(emailPatter)!=null || sifra.match(sifraPatter)!=null)
//         {
//             document.getElementById("greskaIme").innerHTML = "";
//             document.getElementById("greskaPrezime").innerHTML = "";
//             document.getElementById("greskaEmail").innerHTML = "";
//             document.getElementById("greskaSifra").innerHTML = "";

            
//         }
//     }
// }

function PrikaziPassword()
{
    var x = document.getElementById("sifra");
    if(x.type==="password")
    {
        x.type = "text";
        document.getElementById("oko").style.color = '#e34b89';
    }
    else
    {
        x.type = "password"
        document.getElementById("oko").style.color = '#164863';
    }  
}