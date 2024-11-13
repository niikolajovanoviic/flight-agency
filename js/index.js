function UcitajStranu()
{
  // citati
  var citat = new Array(11);
  var autor = new Array(11);
  
  citat[0] = "Putovanja čine da postanemo skromniji. Uvidite koliko malo mesto zauzimate u svetu.";
  autor[0] = "Gustav Flober";
  
  citat[1] = "Putovanje je mnogo više od razgledanja spomenika, to je duboka i trajna promena ideje življenja.";
  autor[1] = "Miriam Beard";
  
  citat[2] = "Putovanja vas prvo ostave bez reči, a onda vas pretvore u pripovedača.";
  autor[2] = "Ibn Batuta";
  
  citat[3] = "Dok putujemo svetom da bismo našli lepotu, moramo je poneti sa sobom ili je nećemo naći.";
  autor[3] = "Ralf Valdo Emerson";
  
  citat[4] = "Samo oni koji će rizikovati da odu predaleko mogu da otkriju koliko daleko može da se ode.";
  autor[4] = "T. S. Eliot";
  
  citat[5] = "Svet je knjiga, a oni koji ne putuju, čitaju samo jednu stranicu.";
  autor[5] = "Sveti Avgustin";

  citat[6] = "Putovanje je najbolji način da pronađete sebe.";
  autor[6] = "Pico Iyer";

  citat[7] = "Nije važno koliko putujemo, već koliko se lepih trenutaka sećamo.";
  autor[7] = "Henry David Thoreau";

  citat[8] = "Putovanje s voljenom osobom je najbolji način da se upoznate, jer tada stvarno vidite sve aspekte njenog karaktera.";
  autor[8] = "Anne Tyler";

  citat[9] = "Putovanje čini jednostrane ljude dvostrano obrazovanim.";
  autor[9] = "Francis Bacon";

  citat[10] = "Putovanje je prilika za susrete s novim ljudima i novim načinima života.";
  autor[10] = "Paulo Coelho";

  citat[11] = "Najbolje uspomene dolaze iz neplaniranih putovanja.";
  autor[11] = "Piolo Damasco";
  
  index = Math.floor(Math.random()*citat.length);
  document.getElementById("citat").innerHTML = citat[index];
  document.getElementById("autor").innerHTML = autor[index];
  
  // brisanjeSvihPolja
  document.getElementById("DestinacijaOd").value = "";
  document.getElementById("DestinacijaDo").value = "";
  document.getElementById("Datum").value = "";
  document.getElementById("BrojPutnika").value = "";
  
  
}


function resetVideo(video) {
  video.currentTime = 0;
}

function onVideoPlay() {
  video.currentTime = 0;
}





