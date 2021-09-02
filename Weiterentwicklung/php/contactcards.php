<?php
include_once 'header.php'
?>
<html lang="de" dir="ltr">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styling.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark justify-content-end">

<?php
echo '<ul class="navbar-nav">';
echo "<li class='nav-item'><a class='nav-link' href='contacts.php'>Listenlayout auswählen</a></li>";
echo '</ul>';
echo '</nav>';
echo '<div class="jumbotron seamless gradient-1">';
echo '<h1 class="text-light">Kontakte</h1>';
echo '<br>';
require 'include/session.inc.php';
require 'include/dbh.inc.php';
$nid = $_SESSION['nid']['nid'];
$state = getState($nid,$conn);
if($state == 2)
{
    $gradyear = getGradyear($nid,$conn);
    $course = getCourse($nid,$conn);
    $unverifiedcoursemates=getunverifiedCourseMates($conn,$course,$gradyear);
    $amount=mysqli_num_rows($unverifiedcoursemates);
    $count = 1;
    if($amount>0)
    {
        echo '<h2 class="text-light">Zu verifizierende ehemalige Kommilitonen der selben Seminargruppe</h2>';
        echo '<br>';
        echo '<div class="card-columns">';
        while ($count <= $amount)
        {
            $row = mysqli_fetch_assoc($unverifiedcoursemates);
            echo '<div class="card">';
            echo '<div class="embed-responsive embed-responsive-1by1">';
            if(isset($row["filename"]))
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/'.$row["filename"].'" alt="Profilbild">';
            }
            else
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/Standard.png" alt="Profilbild">';
            }
            
            echo '</div>';
            echo '<div class="card-body text-center">';
            if($row["title"]=="")
            {
                echo '<h4 class="card-title">'.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            else
            {
                echo '<h4 class="card-title">'.$row["title"].' '.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            echo '<p class="card-text"></p>';
            echo '<a href="contactinfo.php?nid='.$row["nid"].'" class="button"><button class="btn btn-primary">Kontakt ansehen</button></a>';
            echo '<br>';
            echo '<a class="button" href="include/contacts.inc.php?parameter='.$row["nid"].'&parameter2=verify&parameter3='.$row["firstname"].'&parameter4='.$row["lastname"].'"><button class="btn btn-success">Kontakt verifizieren</button></a>';
            echo '<br>';
            echo '</div>';
            $count = $count + 1;
        }
        echo '</div>';
    }
    
    
    // Ehemalige Kommilitonen der selben Seminargruppe
    
    $verifiedcoursemates=getverifiedCourseMates($conn,$course,$gradyear);
    $amount=mysqli_num_rows($verifiedcoursemates);
    $count = 1;
    if($amount>0)
    {
        echo '<h2 class="text-light">Ehemalige Kommilitonen der selben Seminargruppe</h2>';
        echo '<br>';
        echo '<div class="card-columns">';
        while ($count <= $amount)
        {
            $row = mysqli_fetch_assoc($verifiedcoursemates);
            echo '<div class="card">';
            echo '<div class="embed-responsive embed-responsive-1by1">';
            if(isset($row["filename"]))
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/'.$row["filename"].'" alt="Profilbild">';
            }
            else
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/Standard.png" alt="Profilbild">';
            }
            
            echo '</div>';
            echo '<div class="card-body text-center">';
            if($row["title"]=="")
            {
                echo '<h4 class="card-title">'.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            else
            {
                echo '<h4 class="card-title">'.$row["title"].' '.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            echo '<p class="card-text"></p>';
            echo '<a href="contactinfo.php?nid='.$row["nid"].'" class="button"><button class="btn btn-primary">Kontakt ansehen</button></a>';
            echo '<br>';
            echo '</div>';
            echo '</div>';
            $count = $count + 1;
        }
        echo '</div>';
    }
    
    // Verantwortliche der BA und das Fördervereins
    
    $staff=getStaff($conn);
    $amount=mysqli_num_rows($staff);
    if($amount>0)
    {
        echo '<h2 class="text-light">Verantwortliche der BA und das Fördervereins</h2>';
        // require 'include/functions3.inc.php';
        $count = 1;
        echo '<div class="card-columns">';
        while ($count <= $amount)
        {
            $row = mysqli_fetch_assoc($staff);
            echo '<div class="card">';
            echo '<div class="embed-responsive embed-responsive-1by1">';
            if(isset($row["filename"]))
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/'.$row["filename"].'" alt="Profilbild">';
            }
            else
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/Standard.png" alt="Profilbild">';
            }
            
            echo '</div>';
            echo '<div class="card-body text-center">';
            if($row["title"]=="")
            {
                echo '<h4 class="card-title">'.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            else
            {
                echo '<h4 class="card-title">'.$row["title"].' '.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            echo '<p class="card-text"></p>';
            echo '<a href="contactinfo.php?nid='.$row["nid"].'" class="button"><button class="btn btn-primary">Kontakt ansehen</button></a>';
            
            echo '<br>';
            echo '</div>';
            echo '</div>';
            $count = $count + 1;
        }
        echo '</div>';
    }
}
elseif($state == 3)
{
    
    //Zu verifizierende Nutzer
    
    $unverifiedaccounts=getunverifiedaccounts($conn);
    $amount=mysqli_num_rows($unverifiedaccounts);
    $count = 1;
    if($amount>0)
    {
        echo '<h2 class="text-light">Zu verifizierende Nutzer</h2>';
        echo '<br>';
        echo '<div class="card-columns">';
        while ($count <= $amount)
        {
            $row = mysqli_fetch_assoc($unverifiedaccounts);
            echo '<div class="card">';
            echo '<div class="embed-responsive embed-responsive-1by1">';
            if(isset($row["filename"]))
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/'.$row["filename"].'" alt="Profilbild">';
            }
            else
            {
                echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/Standard.png" alt="Profilbild">';
            }
            
            echo '</div>';
            echo '<div class="card-body text-center">';
            if($row["title"]=="")
            {
                echo '<h4 class="card-title">'.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            else
            {
                echo '<h4 class="card-title">'.$row["title"].' '.$row["firstname"].' '.$row["lastname"].'</h4>';
            }
            echo '<p class="card-text"></p>';
            echo '<a href="contactinfo.php?nid='.$row["nid"].'" class="button"><button class="btn btn-primary">Kontakt ansehen</button></a>';
            echo '<br>';
            echo '<br>';
            echo '<a class="button" href="include/contacts.inc.php?parameter='.$row["nid"].'&parameter2=delete&parameter3='.$row["firstname"].'&parameter4='.$row["lastname"].'"><button class="btn btn-danger">Kontakt löschen</button></a>';
            echo '<br>';
            echo '<br>';
            echo '<a class="button" href="include/contacts.inc.php?parameter='.$row["nid"].'&parameter2=verify&parameter3='.$row["firstname"].'&parameter4='.$row["lastname"].'"><button class="btn btn-success">Kontakt verifizieren</button></a>';
            echo '<br>';
            echo '</div>';
            echo '</div>';
            $count = $count + 1;
        }
        echo '</div>';
    }
    require 'include/eventfunctions.inc.php';
    
    
    // Verifizierte Accounts nach Seminargruppen
    
    $groups=getGroups($conn);
    $amountg=mysqli_num_rows($groups);
    $countg = 1;
    if($amountg > 0)
    {
        echo '<h2 class="text-light">Verifizierte Accounts nach Seminargruppen</h2>';
        echo '<br>';
        while ($countg <= $amountg)
        {
            $row = mysqli_fetch_assoc($groups);
            $course=$row["course"];
            $gradyear=$row["gradyear"];
            $verifiedcoursemates=getverifiedCourseMates($conn,$course,$gradyear);
            $amount=mysqli_num_rows($verifiedcoursemates);
            $count = 1;
            echo '<h3 class="text-light">Abschlussjahr: '.$gradyear.''.', Studienrichtung: '.$course.'</h3>';
            if($amount>0)
            {
                echo '<div class="card-columns">';
                while ($count <= $amount)
                {
                    $row = mysqli_fetch_assoc($verifiedcoursemates);
                    echo '<div class="card">';
                    echo '<div class="embed-responsive embed-responsive-1by1">';
                    if(isset($row["filename"]))
                    {
                        echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/'.$row["filename"].'" alt="Profilbild">';
                    }
                    else
                    {
                        echo '<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="uploads/profilbilder/Standard.png" alt="Profilbild">';
                    }
                    
                    echo '</div>';
                    echo '<div class="card-body text-center">';
                    if($row["title"]=="")
                    {
                        echo '<h4 class="card-title">'.$row["firstname"].' '.$row["lastname"].'</h4>';
                    }
                    else
                    {
                        echo '<h4 class="card-title">'.$row["title"].' '.$row["firstname"].' '.$row["lastname"].'</h4>';
                    }
                    echo '<p class="card-text"></p>';
                    echo '<a href="contactinfo.php?nid='.$row["nid"].'" class="button"><button class="btn btn-primary">Kontakt ansehen</button></a>';
                    echo '<br>';
                    echo '<br>';
                    echo '<a class="button" href="include/contacts.inc.php?parameter='.$row["nid"].'&parameter2=delete&parameter3='.$row["firstname"].'&parameter4='.$row["lastname"].'"><button class="btn btn-danger">Kontakt löschen</button></a>';
                    echo '<br>';
                    echo '<br>';
                    if($row["state"]==2)
                    {
                        echo '<a class = "button" href="include/contacts.inc.php?parameter='.$row["nid"].'&parameter2=adminstrieren&parameter3='.$row["firstname"].'&parameter4='.$row["lastname"].'"><button class="btn btn-warning">Kontakt zum Administrator machen</button></a>';
                        echo '<br>';
                    }
                    echo '</div>';
                    
                    echo '</div>';
                    $count = $count + 1;
                }
                echo '</div>';
            }
            $countg = $countg + 1;
        }
    }
}
else
{
    echo 'Unberechtigter Zugriff';
}
?>
<?php
include_once 'footer.php'
?>
<?php
/*
 
 */
?>
