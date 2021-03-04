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
                  echo '<p class="text-right">Eingeloggt als: '.getMail($sessionnid,$conn).'</p>';
                  echo '<h3>Suche</h3>';
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
                  echo '<td><a href="include/search.inc.php"> <button class="btn btn-primary"> Suchen </button></a></td>';
                  echo '</div>';
                  echo '<div class="form-group col-md-3">';
                  echo '<td><a href="contacts.php"> <button class="btn btn-secondary"> Suche zurücksetzen </button></a></td>';
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
                      $stmt = mysqli_stmt_init($conn);
                      $selektor="";
                      if(isset($_GET["parameter"]))
                      {
                          $selektor=$_GET["parameter"];
                      }
                      $rumpf="SELECT N.nid, gradyear, course, firstname, lastname, company, position, mail, twitter, instagram, xing, linkedIn, school, others, showname, state  FROM (Nutzer N INNER JOIN Statenames S ON N.state=S.stateID) LEFT JOIN ExternalLinks E on N.nid = E.nid";
                      $orderby="ORDER BY gradyear desc, course asc, state asc";
                      if($selektor=="search")
                      {
                          $firstname="%".$_GET["parameter2"]."%";
                          $lastname="%".$_GET["parameter3"]."%";
                          $company="%".$_GET["parameter4"]."%";
                          $position="%".$_GET["parameter5"]."%";
                          if($status==3)
                              {
                                  $gradyear = $_GET["parameter6"];
                                  $course = "%".$_GET["parameter7"]."%";
                                  if($gradyear!="")
                                  {
                                      $where="WHERE firstname LIKE ? AND lastname LIKE ? AND gradyear=? AND course LIKE ? AND company LIKE ? AND position LIKE ?";
                                      $abfrage=$rumpf." ".$where." ".$orderby;
                                      mysqli_stmt_prepare($stmt,$abfrage);
                                      mysqli_stmt_bind_param($stmt,"ssssss",$firstname,$lastname,$gradyear,$course,$company,$position);
                                  }
                                  else
                                  {
                                      $where="WHERE firstname LIKE ? AND lastname LIKE ? AND course LIKE ? AND company LIKE ? AND position LIKE ?";
                                      $abfrage=$rumpf." ".$where." ".$orderby;
                                      mysqli_stmt_prepare($stmt,$abfrage);
                                      mysqli_stmt_bind_param($stmt,"sssss",$firstname,$lastname,$course,$company,$position);
                                 }
                              }
                          else
                              {
                                  $gradyear=getGradyear($sessionnid,$conn);
                                  $course=getCourse($sessionnid,$conn);
                                  $where="WHERE firstname LIKE ? AND lastname LIKE ? AND gradyear=? AND course LIKE ? AND company LIKE ? AND position LIKE ?";
                                  $abfrage=$rumpf." ".$where." ".$orderby;
                                  mysqli_stmt_prepare($stmt,$abfrage);
                                  mysqli_stmt_bind_param($stmt,"ssssss",$firstname,$lastname,$gradyear,$course,$company,$position);
                              }
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
                          mysqli_stmt_prepare($stmt,$abfrage);
                      }
                      mysqli_stmt_execute($stmt);
                      if ($result = mysqli_stmt_get_result($stmt))
                      {
                          $count = mysqli_num_rows($result);
                          echo '<table width="100%" height="45%" class="table-hover table-dark table-bordered table-responsive"  >';
                          echo '<thead>';
                          echo '<tr class="">';
                          echo '<th class="th">'.'Abschlussjahr'.'</th>';
                          echo '<th class="th">'.'Studienrichtung'.'</th>';
                          echo '<th class="th">'.'Vorname'.'</th>';
                          echo '<th class="th">'.'Nachname'.'</th>';
                          echo '<th class="th">'.'Firma'.'</th>';
                          echo '<th class="th">'.'Position'.'</th>';
                          echo '<th class="th">'.'Email-Adresse'.'</th>';
                          echo '<th class="th">'.'Twittername'.'</th>';
                          echo '<th class="th">'.'Instagram'.'</th>';
                          echo '<th class="th">'.'Xing'.'</th>';
                          echo '<th class="th">'.'LinkedIn'.'</th>';
                          echo '<th class="th">'.'Hochschule'.'</th>';
                          echo '<th class="th">'.'Sonstiges'.'</th>';
                          echo '<th class="th">'.'Status'.'</th>';
                          echo '<th class="th">'.'Verifizieren'.'</th>';
                          if($status==3)
                                {
                                    echo '<th class="th">'.'Löschen'.'</th>';
                                    echo '<th class="th">'.'zum Administrator machen'.'</th>';
                                }
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                for ($i = 0; $i < $count; $i++)
                                    {
                                        echo '<tr class="">';
                                        $row = mysqli_fetch_array($result);
                                        for ($j = 1; $j < 15; $j++)
                                        {
                                            echo "<td class='td text-center'>{$row[$j]}</td>";
                                        }
                                        if($row[15]==1)
                                        {
                                            if($j==15)
                                            {
                                                echo '<td class="td"> <a href="include/contacts.inc.php?parameter='.$row[0].'&parameter2=verify&parameter3='.$row[3].'&parameter4='.$row[4].'"> <button class="btn btn-success">verifizieren </button></a></td>';
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
                                                echo '<td class=td> <a href="include/contacts.inc.php?parameter='.$row[0].'&parameter2=delete&parameter3='.$row[3].'&parameter4='.$row[4].'"> <button class="btn btn-danger">delete </button></a></td>';
                                            }
                                            if($row[15]==2)
                                            {
                                                echo '<td class=td> <a href="include/contacts.inc.php?parameter='.$row[0].'&parameter2=adminstrieren&parameter3='.$row[3].'&parameter4='.$row[4].'"> <button class="btn btn-info">administrator </button></a></td>';
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
                  echo "<h4>Bitte lassen Sie sich erst verifizieren</h4>";
              }
          }
          else
          {
                echo "<h4>Kein berechtigter Nutzer</h4>";
          }
    }
    else
    {
        echo "<h4>Bitte loggen Sie sich ein.</h4>";
    }
?>

<?php
include_once 'footer.php'
?>
