<?php include './include/title.php'; 
//ini_set("smtp_port","25");
    $error = [];
    $missing = [];
    if(isset($_POST['send'])){
        $to = "abiolaoluwaseyi2012@gmail.com";
        $subject = "Feedback from Japan Journey";
        
        //List Expected user
        $expected = ['name', 'email', 'comments', 'subscribe', 'interests', 'howhear', 'characteristics', 'terms'];
//        
        //List the required user
        $required = ['name', 'comments', 'email', 'subscribe', 'interests', 'howhear', 'characteristics', 'items'];
        
        //to test for the radio button check
        //setting default variables that might not exist
        if(!isset($_POST['subscribe'])){
            $_POST['subscribe'] = '';
        }
        if(!isset($_POST['interests'])){
            $_POST['interests'] = [];
        }
        //minimum number of required check boxes
        $minCheckboxes = 2;
        if(count($_POST['interests']) < $minCheckboxes){
            $error['interests'] = true;
        }
        
        //for select option
        
        if(!isset($_POST['howhear'])){
            $_POST['howhear'] = '';
        }
        
        //for multiple selection
        if(!isset($_POST['characteristics'])){
            $_POST['characteristics'] = [];
        }
        
        //for accepting the terms
        if(!isset($_POST['terms'])){
            $_POST['terms'] = '';
            $error['terms'] = true;
        }
        
        //create additional header
        $headers = "From: Japan Journey<feedback@example.com>\r\n";
        $headers.= 'Content-Type: text/plain; charset="utf-8"';
        
        include './include/processmail.php';
        //redirecting after successfully sent mail
        if($mailSent){
            //$address = "localhost/works/thank_you.php";
            header('Location: ./thank_you.php');
            exit;
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"><!--which supports most written languages, including the accents ommonly used in European languages, as well as nonalphabetic scripts, such as Chinese and Japanese.-->
    <title>Japan Journey<?php if(isset($title)){ echo "&#8212;{$title}";} ?></title>
    <link href="styles/journey.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <h1>Japan Journey </h1>
</header>
<div id="wrapper">
    <?php require './include/menu.php'; ?>
    <main>
        <h2>Contact Us  </h2>
        <?php if(($_POST && $suspect)||($_POST && isset($error['mailfail']))){ ?> <p class="warning">Sorry, your mail cannot be sent. Please try later</p> <?php } 
        elseif($missing || $error){ ?>
        <p class="warning">Please fix the item(s) indicated</p> <?php } ?>
                
      <p>Ut enim ad minim veniam, quis nostrud exercitation consectetur adipisicing elit. Velit esse cillum dolore ullamco laboris nisi in reprehenderit in voluptate. Mollit anim id est laborum. Sunt in culpa duis aute irure dolor excepteur sint occaecat.</p>
      <form method="post" action="" enctype="multipart/form-data">
            <p>
                <label for="name">Name: <?php if($missing && in_array('name', $missing)) { ?>
                <span class="warning">Please enter your name</span><?php } ?>
                    
                </label>
                <input name="name" id="name" type="text" <?php if($missing || $error){ echo 'value ="' .htmlentities($name). '"';}?>>
                
            </p>
            <p>
                <label for="email">Email: <?php if($missing && in_array('email', $missing)){ ?>
                    
                    <span class="warning">Please enter your email address</span><?php } elseif(isset ($error['email'])){
                        ?><span class="warning">Invalid email address</span>
                        
                    <?php } ?>
                   
                    </label>
                <input name="email" id="email" type="text" <?php if($missing || $error){ echo 'value ="' . htmlentities($email). '"';}?>>
                
            </p>
            <p>
                <label for="comments">Comments: <?php if($missing && in_array('comments', $missing)) { ?>
                <span class="warning">Please enter a comment</span><?php } ?>
                    
                </label>
                <textarea name="comments" id="comments"><?php 
                    if($missing||$error){echo htmlentities($comments);
                    }?></textarea>
            </p>
            <fieldset id="subscribe">
                <h2>Subscribe to our Newsletter?</h2>
                <?php
                    if($missing && in_array('subscribe', $missing)){?>
                    <span class="warning">Please make a selection</span>
                    <?php } ?>
                <p>
                    <input type="radio" name="subscribe" value="Yes" id="subscribe-yes" <?php
                        if($_POST && $_POST['subscribe'] == 'Yes'){
                            echo 'checked';
                        }
                    ?>>
                    <label for="subscribe-yes">Yes</label>
                    <input type="radio" name="subscribe" value="No" id="subscribe-no" <?php
                        if(!$_POST || $_POST['subscribe'] == 'No'){
                            echo 'checked';
                        }
                    ?>>
                    <label for="subscribe-no">No</label>
                </p>
            </fieldset>
            <fieldset id="interests">
                <h2>Interest in Japan Journey</h2>
                <?php if(isset($error['interests'])){ ?>
                    <span class="warning">Please select at least <?= $minCheckboxes ?> </span>
                <?php } ?>
                <div>
                    <p>
                        <input type="checkbox" name="interests[]" id="anime" value="Anime/manga" <?php
                            if($_POST && in_array('Anime/manga', $missing)){
                                echo 'checked';
                            }
                        ?>>
                        <label for="Anime">Anime/manga</label>
                    </p>
                    <p>
                        <input type="checkbox" name="interests[]" id="art" value="Arts & Craft" <?php
                            if($_POST && in_array('Arts & Craft', $missing)){
                                echo 'Checked';
                            }
                        ?>>
                        <label for="art">Arts &amp; Crafts</label>
                    </p>
                    <p>
                        <input type="checkbox" name="interests[]" id="judo" value="Judo/Karate" <?php
                            if($_POST && in_array('Judo/Karate', $missing)){
                                echo 'checked';
                            }
                        ?>>
                        <label for="judo">Judo, Karate, etc.</label>
                    </p>
                </div>
                <div>
                    <p>
                        <input type="checkbox" name="interests[]" id="language" value="Language/literature" <?php
                            if($_POST && in_array('Language/literature', $missing)){
                                echo 'Checked';
                            }
                        ?>>
                        <label for="language">Language/Literature</label>
                    </p>
                    <p>
                        <input type="checkbox" name="interests[]" id="science" value="Science & Technology" <?php
                            if($_POST && in_array('Science & Technology', $missing)){
                                echo 'Checked';
                            }
                        ?>>
                        <label for="science">Science &amp; Technology</label>
                    </p>
                    <p>
                        <input type="checkbox" name="interests[]" id="travels" value="Travels" <?php
                            if($_POST && in_array('Travels', $missing)){
                                echo 'Checked';
                            }
                        ?>>
                        <label for="travels">Travels</label>
                    </p>
                </div>
            </fieldset>
            
            <p>
                <label for="howhear">How did you hear about the Journey to Japan?
                    <?php if($missing && in_array('howhear', $missing)){ ?>
                    <span class="warning">Please make a selection</span>
                   <?php } ?>
                </label>
                <select name="howhear" id="howhear">
                    <option value="" <?php
                        if(!$_POST || $_POST['howhear'] == ''){
                            echo 'Selected';
                        }
                    ?>>Select One</option>
                    <option value="Twitter" <?php 
                        if(($_POST) && $_POST['howhear'] == 'Twitter'){
                        echo 'Selected';
                    }
                    ?>>Twitter</option>
                    
                    <option value="Facebook" <?php
                        if(($_POST) && $_POST['howhear'] == 'Facebook'){
                            echo 'Selected';
                        }
                    ?>>Facebook</option>
                    
                    <option value="Apress" <?php
                        if(($_POST) && $_POST['howhear'] == 'Apress'){
                            echo 'Selected';
                        }
                    ?>>Apress</option>
                    <option value="Instagram" <?php
                        if(($_POST) && $_POST['howhear'] == 'Instagram'){
                            echo 'Selected';
                        }
                    ?>>Instagram</option>
                    
                    <option value="Deezer" <?php
                        if($_POST && $_POST['howhear'] == 'Deezer'){
                            echo 'Selected';
                        }
                    ?>>Deezer</option>
                </select>
            </p>
            <p>
                <label for="characteristics">What Characteristics do you associate with Japan?</label>
                <select name="characteristics[]" size="6" multiple="multiple" id="characteristics">
                    <option value="Dynamic" <?php
                        if($_POST && in_array('Dynamic', $_POST['characteristics'])){
                            echo 'Selected';
                        }
                    ?>>Dynamic</option>
                    <option value="Honest" <?php
                        if($_POST && in_array('Honest', $_POST['characteristics'])){
                            echo 'Selected';
                        }
                    ?>>Honest</option>
                    <option value="Biased" <?php
                        if($_POST && in_array('Biased', $_POST['characteristics'])){
                            echo 'Selected';
                        }
                    ?>>Biased</option>
                    
                    <option value="Accomodating" <?php
                        if($_POST && in_array('Accomodating', $_POST['characteristics'])){
                        echo 'Selected';
                        }
                    ?>>Accomodating</option>
                    <option value="Irritating" <?php
                        if($_POST && in_array('Irritating', $_POST['characteristics'])){
                            echo 'Selected';
                        }
                    ?>>Irritating</option>
                    <option value="Welcoming" <?php
                        if($_POST && in_array('Welcoming', $_POST['characteristics'])){
                            echo 'Selected';
                        }
                    ?>>Welcoming</option>
                </select>
            </p>
            <p>
                <input type="checkbox" name="terms" value="accepted" id="terms" <?php
                    if($_POST && !isset($error['terms'])){
                        echo 'Checked';
                    }
                ?>>
                <label for="terms">I accept the terms of using this website
                    <?php if(isset($error['terms'])){?>
                    <span class="warning">Please select the checkbox</span>
                    <?php } ?>
                </label>
            </p>
            
            <p>
                <input name="send" type="submit" value="Send message">
            </p>
        </form>
      <pre>
          <?php
                /*if ($_POST){ print_r($_POST); }
                if($_POST && $mailSent) {
                echo "Message body\n\n";
                echo htmlentities($message) . "\n";
                echo 'Headers: '. htmlentities($headers);
                }
               */ 
               
          ?>
          
      </pre>
    </main>
    <?php include './include/footer.php'; ?>
</div>
</body>
</html>
