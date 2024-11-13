function Reset()
{
    document.getElementById("email").value="";
    document.getElementById("sifra").value="";
}


// function Provera()
// {
//     var email = document.getElementById("email").value;
//     var sifra = document.getElementById("sifra").value;
    
//     if(email=="" || sifra=="")
//     {
//         document.getElementById("greskaPrazno").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Morate popuniti sva polja za unos!";
//     }
//     else
//     {
//         document.getElementById("greskaPrazno").innerHTML = "";
        
        
//         var emailPatter = /^.{2,32}[@]{1}[a-z0-9]{3,16}[.]{1}[a-z]{2,6}$/g
//         //sifra
//         var sifraPatter = /^.{8,16}$/g
        
//         if(email.match(emailPatter)==null || sifra.match(sifraPatter)==null)
//         {
            
//             document.getElementById("greskaEmail").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Pogrešna e-mail adresa!";
//             if(email.match(emailPatter)!=null)
//             {
//                 document.getElementById("greskaEmail").innerHTML = "";
//             }
            
//             document.getElementById("greskaSifra").innerHTML = "<i class='fa-solid fa-triangle-exclamation' style='color: #950004;'></i>" + " Pogrešna šifra!";
//             if(sifra.match(sifraPatter)!=null)
//             {
//                 document.getElementById("greskaSifra").innerHTML = "";
//             }
//         }
//         else if(email.match(emailPatter)!=null || sifra.match(sifraPatter)!=null)
//         {
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
