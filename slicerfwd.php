                                                                                                                                                                                                                                                                                    <html><head>
  <title>Slicer2.2</title>
  
  <link rel="stylesheet" href="/style.css">
  </head>

<body>

 <ul class="navbar">
	<li><a href="/index.html">Startseite</a>
	<li><a href="/Javascript/javascript.html">Javascript</a>
	<li><a href="/PHP/php.html">PHP</a>
	<li><a href="vulnerabilities.html">Vulns</a>
 </ul>
  
 <center><h1>Slicer 2.2</h1>
 <br />
 <br />
  <?php
    $suche = $_POST["art"];
    $begrenzung = $_POST["begrenzung"];
	$filterung = $_POST["filterung"];
    $eingabe = "$begrenzung" .$_POST["eingabe"]. "$begrenzung"; //Siehe *1
    $rpos = 1;
    $anzahl = substr_count($eingabe, $suche);
	$array = array();
    
	$counter = 1;
	while($counter <= $anzahl) {
	
	$pos = strpos($eingabe, $suche, $rpos); //Suche nach $suche
	$rpos1 = strpos($eingabe, "\n", $pos); //Suche nach $begrenzung rechts
	$rpos2 = strpos($eingabe, $begrenzung, $pos);
		
	  if($rpos1 <= $rpos2) {
        $rpos = $rpos1;
      }
      else {
        $rpos = $rpos2;
      }
   
    $i = 1; //Suche nach $begrenzung links
    while($i < 65) {
      $lpos = substr($eingabe, $pos-$i, 1);
      if($lpos == $begrenzung OR $lpos == "\n") {
        break;
      }  
      else {
        $i++;
      }
    }
    
    $start = $pos - $i+1;
    $laenge = $rpos - $start;
    $ausgabe = substr($eingabe, $start, $laenge);
	
	if(substr($ausgabe, $laenge - strlen($filterung), strlen($filterung)) == $filterung) {
		$array[] = $ausgabe;
	}
	else if($filterung == "all") {
		$array[] = $ausgabe;
	}
		
  $counter++;  
  }
  
  if(isset($_POST["duplikate"])) {
	$sort_array = array_unique($array);
	$real_anz = count($sort_array);
  }
  else {
    $real_anz = count($array);
  }
  
  if($anzahl !== FALSE) { //Ausgabe Form
      if($anzahl == 1) {
        echo "Die Suche f&uumlhrte zu <b>einem</b> Ergebnis:<br /><br />";
      }
      else {
        echo "Die Suche f&uumlhrte zu <b>" .$real_anz. "</b> Ergebnissen:<br/><br />";
      }
    }
    else {
      echo "Es wurde nichts gefunden.";
    }
  
  if(isset($_POST["duplikate"])) {
	foreach($sort_array as $sort_result) {
		echo $sort_result. "<br />";
	}
  }
  else {
	foreach($array as $result) {
		echo $result. "<br />";
	}
  }
  
  /*  *1 
		 Alternativ wäre auch folgendes möglich um das Ende des Strings zu berücksichtigen:
         if($rpos == "") {
          $rpos = strlen($eingabe);
         }
         else {
         }
  */        

  ?>
 <br />
 <br />
 </center>
  <br />
  <br />
  <a href="/PHP/Slicer 2.2/slicer2.2.html">zurück</a>
 
	<center><info>2012</info></center>
  
</body>
</html>