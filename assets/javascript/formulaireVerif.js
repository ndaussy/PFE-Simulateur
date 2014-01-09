<!--
function verif_formulaire()
{
 if(document.formulaire.nom.value == "")  {
   alert("Veuillez entrer votre nom!");
   document.formulaire.nom.focus();
   return false;
  }
 if(document.formulaire.lieu.value == "") {
   alert("Veuillez entrer votre lieu de résidence!");
   document.formulaire.lieu.focus();
   return false;
  }
 if(document.formulaire.courriel.value == "") {
   alert("Veuillez entrer votre adresse électronique!");
   document.formulaire.courriel.focus();
   return false;
  }
 if(document.formulaire.courriel.value.indexOf('@') == -1) {
   alert("Ce n'est pas une adresse électronique!");
   document.formulaire.courriel.focus();
   return false;
  }
 if(document.formulaire.age.value == "") {
   alert("Veuillez entrer votre âge!");
   document.formulaire.age.focus();
   return false;
  }
 var chkZ = 1;
 for(i=0;i<document.formulaire.age.value.length;++i)
   if(document.formulaire.age.value.charAt(i) < "0"
   || document.formulaire.age.value.charAt(i) > "9")
     chkZ = -1;
 if(chkZ == -1) {
   alert("Cette mention n'est pas un nombre!");
   document.formulaire.age.focus();
   return false;
  }
}
//-->
</script>