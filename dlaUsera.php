<?php 
    session_start();
    if(!isset($_SESSION['loged'])){
        header("Location: index.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang = "pl">
    <head>
    <title> Freeraceling Platform- Twój profil</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="styles/index.css"/>
        <link rel="stylesheet" href="styles/profile.css"/>
    </head>
    <body>
        <header class = "header--Profile">
            <a href = "index.html" class = "header__link"><h1>Witaj <?php echo $_SESSION['name'] ?></h1></a>
            <a href = "scripts/php/logout.php" class = "header__link--logout">wyloguj się</a>
        </header>
        <main class = "main">
            <nav class = "nav--profile">
                <?php 
                    if($_SESSION['role'] == "freelanc"){
                        echo "<h2> Zlecenia które wykonujesz</h2>";
                        echo '<iframe src = "scripts/php/freelancOrders1.php" class = "profile__iframe"></iframe>';
                    }elseif ($_SESSION['role'] == "recruit") {
                        echo "<h2> Zlecenia które utworzyłeś</h2>";
                        echo '<iframe src = "scripts/php/recruitOrders1.php" class = "profile__iframe"></iframe>';
                    }
                ?>
            </nav>
            <section class = "section--profile">
                <?php
                    $id = $_SESSION['id'];
                    if($_SESSION['role'] == "freelanc"){
                        echo<<<END
                        <article class = "section__article">
                            <h2>edytuj profil</h2>
                            <br/>
                            <br/>
                            <form method="post" action="scripts/php/editProf.php">
                                <input type = "email" name = "email" placeholder="e-mail" class = "form__input"/><br/><br/>
                                <textarea placeholder="Opis" name = "desc" style = "resize:vertical; height: 150px;" class = "form__input"></textarea><br/><br/>
                                <input type = "text" name = "name" placeholder="imię" class = "form__input"/><br/><br/>
                                <input type = "text" name = "surname" placeholder="nazwisko" class = "form__input"/><br/><br/>
                                <select label = "type" name = "type">
                                    <optgroup label = "Web-developerzy">
                                        <option value="Front">Front-end developerzy</option>
                                        <option value="Back">Back-end developerzy</option>
                                        <option value="Full">Full-Stack developerzy</option>
                                    </optgroup>
                                    <optgroup label=" Aplikacje Mobilne">
                                        <option value="Android"> Na Androida</option>
                                        <option value="IOS"> Na IOS</option>
                                        <option value="App-Full"> Na IOS i Androida</option>
                                    </optgroup>
                                    <optgroup label = "Aplikacje Desktopowe">
                                        <option value="Windows"> Na Windows</option>
                                        <option value="Mac"> Na MacOs</option>
                                        <option value="Linux"> Na Linux</option>
                                    </optgroup>
                                    <optgroup label = "designers">
                                        <option value = "Web">Web-designer</option>
                                        <option value = "Clothes">Projektant Ubrań</option>
                                        <option value = "House">Projektant Wnętrz</option>
                                        <option value = "Graf">Projektant Grafik</option>
                                        <option value = "3d">Projektant 3D</option>
                                        <option value = "Arch">Architekt</option>
                                    </optgroup>
                                    <optgroup label="Fotografia">
                                        <option value = "Photo">Fotograf</option>
                                        <option value = "Model">Model</option>
                                        <option value = "edit">Edytor Zdjęć</option>
                                    </optgroup>
                                    <optgroup label="Wideo">
                                        <option value = "Camera">Kamerzysta</option>
                                        <option value = "edit">Montażysta</option>
                                    </optgroup>
                                    <optgroup label="Dźwięk">
                                        <option value = "Camera">Lektorzy</option>
                                        <option value = "edit">Montażysta Dźwięku</option>
                                    </optgroup>
                                    <optgroup label = "SEO i Marketing">
                                        <option value = "SEO">Specjalista SEO</option>
                                        <optgroup label="Marketing">
                                        <option value = "Social">Marketing w Social Media</option>
                                        <option value = "Ads">Specjalista Reklamowy</option>
                                        <option value = "Afil">Marketing Afiliacyjny</option>
                                    </optgroup>
                                    <optgroup label = "Teksty">
                                        <option value = "transl">Tłumaczenia</option>
                                        <option value = "articles">Artytuły</option>
                                        <option value = "Copy">Copywriting</option>
                                        <option value = "descs">Opisy</option>                                 
                                    </optgroup>
                                </select> 
                                <br/>
                                <br/>
                                <input type = "hidden" value = "$id" name = "id"/>
                                <input type = "submit" value = "Edytuj Profil" class = "form__input--submit"/>
                            
                            </form>
                        </article>
                        <article class = "section_article">

                        </article>
                        END;
                    }elseif ($_SESSION['role'] == "recruit") {
                        echo<<<END
                            <article class = "section__article">
                            <h2>dodaj zlecenie</h2>
                            <br/>
                            <form method="post" action="scripts/php/addOrder.php">
                                    <input type = "text" name = "title" placeholder="tytuł zlecenia" class = "form__input"/><br/><br/>
                                    <textarea placeholder="Opis" name = "desc" style = "resize:vertical; height: 192px;" class = "form__input"></textarea><br/><br/>
                                    <input type = "number" name = "price" placeholder="Cena" class = "form__input--price"/>
                                    <input type = "date" name = "date" placeholder="Do kiedy jest otwarte zlecenie" class = "form__input"/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <input type = "submit" value = "Dodaj zlecenie" class = "form__input--submit"/>
                            </form>
                            </article>
                            <article class = "section__article">
                                <h2>edytuj profil</h2>
                                <br/>
                                <form method="post" action="scripts/php/editProf.php">
                                    <input type = "email" name = "email" placeholder="e-mail" class = "form__input"/><br/><br/>
                                    <textarea placeholder="Opis" name = "desc" style = "resize:vertical; height: 192px;" class = "form__input"></textarea><br/><br/>
                                    <input type = "text" name = "name" placeholder="imię" class = "form__input"/><br/><br/>
                                    <input type = "text" name = "surname" placeholder="nazwisko" class = "form__input"/><br/><br/>
                                    <input type = "hidden" value = "$id" name = "id"/>
                                    <input type = "submit" value = "Edytuj Profil" class = "form__input--submit"/>
                            </form>
                            </article>
                        END;
                    }
                ?>
            </section>
            <nav class = "nav--profile" style = "text-align: right;">
                <?php 
                    if($_SESSION['role'] == "freelanc"){
                        echo "<h2> szukaj zleceń</h2>";
                        echo '<iframe src = "scripts/php/freelancOrders2.php" class = "profile__iframe"></iframe>';
                    }elseif ($_SESSION['role'] == "recruit") {
                        echo "<h2> Zlecenia które utworzyłeś</h2>";
                        echo '<iframe src = "scripts/php/recruitOrders2.php" class = "profile__iframe"></iframe>';
                    }
                ?>
            </nav>
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
