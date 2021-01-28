<?php session_start(); ?>
<!DOCTYPE html> 
<html>
    <head>
        <title> Freeraceling Platform- Zarejestruj się</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="styles/index.css"/>
        <link rel="stylesheet" href="styles/register.css"/>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="scripts/JS/Showpass.js"></script>
    </head>
    <body>
        <header class = "header">
            <a href = "index.html"><h1>Zarejestruj się u nas</h1></a>
            
        </header>
        <main class = "main">
            <section class = "section">
                <fieldset>
                    <h2>Zarejestruj się</h2>
                    <form action = "scripts/php/register.php" method = "POST">
                        <input type = "text" name = "login" class = "register__input" placeholder="Login"/>
                        <br/>
                        <?php 
                            if(isset($_SESSION['e_login'])){
                                echo '<span class = "error">'.$_SESSION['e_login'].'</span>';
                                unset($_SESSION['e_login']);
                            }
                        ?>
                        <br/>
                        <input type = "email" name = "email" class = "register__input" placeholder="Email"/>
                        <br/>
                        <?php 
                            if(isset($_SESSION['e_mail'])){
                                echo '<span class = "error">'.$_SESSION['e_mail'].'</span>';
                                unset($_SESSION['e_mail']);
                            }
                        ?>
                        <br/>
                        <input type = "password" name = "pass" id = "pass"  class = "register__input" placeholder="Hasło"/>
                        <input type = "password" name = "pass2" id = "pass2"  class = "register__input" placeholder="Powtórz Hasło"/>
                        <label ><br/><input  type = "checkbox" onclick="showpass()" />Pokaż hasła</label>
                        <br/>
                        <?php 
                            if(isset($_SESSION['e_pass'])){
                                echo '<span class = "error">'.$_SESSION['e_pass'].'</span>';
                                unset($_SESSION['e_pass']);
                            }
                        ?>
                        <br/>
                        <br/>
                        <div class="g-recaptcha" data-sitekey="6LdnnD8aAAAAAHPtaZAT6Qjruc9P-wRjmocz3YJ3"></div>
                        <?php 
                            if(isset($_SESSION['e_bot'])){
                                echo '<span class = "error">'.$_SESSION['e_bot'].'</span>';
                                unset($_SESSION['e_bot']);
                            }
                        ?>
                        <br/>
                        <label ><br/><input  type = "checkbox" name = "ToS"/>Akceptuję Regulamin</label>
                        <br/>
                        <?php 
                            if(isset($_SESSION['e_ToS'])){
                                echo '<span class = "error">'.$_SESSION['e_ToS'].'</span>';
                                unset($_SESSION['e_ToS']);
                            }
                        ?><br/>
                        <input type = "submit" value = "Zarejestruj się" class = "register__input--submit"/>
                        
                    </form>

                    </form>
                </fieldset>
            </section>
        </main>
        <footer class = "footer">
            <h4>Copywritited by Freeraceling-Platform.org &copy;</h4>
            <a href = "about.html">O nas</a>
            <br/>
            kontakt
            <br/>
            <a href = "report.php">zgłoś błąd</a>
            <br/>
        </footer>
    </body>
</html>