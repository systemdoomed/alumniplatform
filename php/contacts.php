<?php
include_once 'header.php'
?>
<div class="jumbotron seamless gradient-2">
<?php
    if(isset($_SESSION['nid']))
    {
      $sessionnid=$_SESSION['nid']['nid'];
      require 'include/dbh.inc.php';
      require 'include/session.inc.php';
      $status=getState($sessionnid,$conn);
      if($status!=0)
          {
              if($status!=1)
              {
                  echo '<form action="include/search.inc.php" method="post">';
                  echo '<label>Suche2</label>';
                  echo '<table>';
                  echo '<tr>';
                  echo '<div class="form-group col-md-3">';
                  echo '<td><label for="searchfirstname" class="text-dark">Vorname</label>';
                  echo '<input type="text" name="searchfirstname" class="form-control" id="searchfirstname" placeholder="Vorname"></input></td>';
                  echo '</div>';
                  echo '<div class="form-group col-md-3">';
                  echo '<td><label for="searchlastname" class="text-dark">Nachname</label>';
                  echo '<input type="text" name="searchlastname" class="form-control" id="searchlastname" placeholder="Nachname"></input></td>';
                  echo '</div>';
                  if($status==3)
                      {
                          echo '<div class="form-group col-md-3">';
                          echo '<td><label for="searchgradyear" class="text-dark">Abschlussjahr</label>';
                          echo '<input type="text" name="searchgradyear" class="form-control" id="searchgradyear" placeholder="Abschlussjahr"></input></td>';
                          echo '</div>';
                          echo '<div class="form-group col-md-3">';
                          echo '<td><label for="searchcourse" class="text-dark">Studienrichtung</label>';
                          echo '<input type="text" name="searchcourse" class="form-control" id="searchcourse" placeholder="Studienrichtung"></input></td>';
                          echo '</div>';
                      }
                  echo '<div class="form-group col-md-3">';
                  echo '<td><label for="searchcompany" class="text-dark">Firma</label>';
                  echo '<input type="text" name="searchcompany" class="form-control" id="searchcompany" placeholder="Firma"></input></td>';
                  echo '</div>';
                  echo '<div class="form-group col-md-3">';
                  echo '<td><label for="searchposition" class="text-dark">Position</label>';
                  echo '<input type="text" name="searchposition" class="form-control" id="searchposition" placeholder="Position"></input></td>';
                  echo '</tr>';
                  echo '<tr>';
                  echo '</tr>';
                  echo '<tr>';
                  echo '</div>';
                  echo '<div class="form-group col-md-3">';
                  echo '<td><a href="include/search.inc.php"> <button> suchen </button></a></td>';
                  echo '</div>';
                  echo '<div class="form-group col-md-3">';
                  echo '<td><a href="contacts.php"> <button> Suche zurücksetzen </button></a></td>';
                  echo '</div>';
                  echo '</tr>';
                  echo '</table>';
                  echo '</form>';
                  if (mysqli_connect_errno())
                  {
                      printf("Connect failed: %s\n", mysqli_connect_error());
                      exit();
                  }
                  else
                  {
                      $selektor="";
                      if(isset($_GET["parameter"]))
                      {
                          $selektor=$_GET["parameter"];
                      }
                      $rumpf="SELECT N.nid, gradyear, course, firstname, lastname, company, position, mail, twitter, instagram, xing, linkedIn, school, others, showname, state  FROM (Nutzer N INNER JOIN Statenames S ON N.state=S.stateID) LEFT JOIN ExternalLinks E on N.nid = E.nid";
                      $orderby="ORDER BY gradyear desc, course asc, state asc";
                      if($selektor=="search")
                      {
                          $where=$_GET["parameter2"];
                          $abfrage=$rumpf." ".$where." ".$orderby;
                      }
                      else
                      {
                          if($status==3)
                          {
                              $abfrage=$rumpf." ".$orderby;
                          }
                          else
                          {
                              $gradyear=getGradyear($sessionnid,$conn);
                              $course=getCourse($sessionnid,$conn);
                              $abfrage=$rumpf.' WHERE gradyear='.$gradyear.' AND course="'.$course.'" '.$orderby;
                          }
                      }
                      if ($result = mysqli_query($conn, $abfrage))
                      {
                          $count = mysqli_num_rows($result);
                          echo '<table style="width:70%" class="table-hover table-borderless">';
                          echo '<thead>';
                          echo '<th class=th>'.'Abschlussjahr'.'</th>';
                          echo '<th class=th>'.'Studienrichtung'.'</th>';
                          echo '<th class=th>'.'Vorname'.'</th>';
                          echo '<th class=th>'.'Nachname'.'</th>';
                          echo '<th class=th>'.'Firma'.'</th>';
                          echo '<th class=th>'.'Position'.'</th>';
                          echo '<th class=th>'.'Email-Adresse'.'</th>';
                          echo '<th class=th>'.'Twittername'.'</th>';
                          echo '<th class=th>'.'Instagram'.'</th>';
                          echo '<th class=th>'.'Xing'.'</th>';
                          echo '<th class=th>'.'LinkedIn'.'</th>';
                          echo '<th class=th>'.'Hochschule'.'</th>';
                          echo '<th class=th>'.'Sonstiges'.'</th>';
                          echo '<th class=th>'.'Status'.'</th>';
                          echo '<th class=th>'.'Verifizieren'.'</th>';
                          if($status==3)
                                {
                                    echo '<th class=th>'.'Löschen'.'</th>';
                                    echo '<th class=th>'.'zum Administrator machen'.'</th>';
                                }
                                echo '</thead>';
                                echo '<tbody>';
                                for ($i = 0; $i < $count; $i++)
                                    {
                                        echo '<tr>';
                                        $row = mysqli_fetch_array($result);
                                        for ($j = 1; $j < 15; $j++)
                                        {
                                            echo "<td class=td>{$row[$j]}</td>";
                                        }
                                        if($row[15]==1)
                                        {
                                            if($j==15)
                                            {
                                                echo '<td class=td> <a href="include/contacts.inc.php?parameter='.$row[0].'&parameter2=verify&parameter3='.$row[3].'&parameter4='.$row[4].'"> <button>verifizieren </button></a></td>';
                                            }
                                        }
                                        else
                                        {
                                            echo '<td class=td></td>';
                                        }
                                        $j++;
                                        if($status==3)
                                        {
                                            if($j==16)
                                            {
                                                echo '<td class=td> <a href="include/contacts.inc.php?parameter='.$row[0].'&parameter2=delete&parameter3='.$row[3].'&parameter4='.$row[4].'"> <button>delete </button></a></td>';
                                            }
                                            if($row[15]==2)
                                            {
                                                echo '<td class=td> <a href="include/contacts.inc.php?parameter='.$row[0].'&parameter2=adminstrieren&parameter3='.$row[3].'&parameter4='.$row[4].'"> <button>administrator </button></a></td>';
                                            }
                                            else
                                            {
                                                echo '<td class=td></td>';
                                            }
                                        }
                                        echo '</tr>';
                                    }
                            echo '</tbody>';
                            echo '</table>';
                            mysqli_free_result($result);
                      }
                  }
              }
              else
              {
                  echo "Bitte lassen Sie sich erst verifizieren";
              }
          }
          else
          {
                echo "Kein berechtigter Nutzer";
          }
    }
    else
    {
        echo "Bitte loggen Sie sich ein";
    }
?>

<?php
include_once 'footer.php'
?>
