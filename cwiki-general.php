<?php

$conn = new CRUD();


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'update-author':

            if ($_POST['new-password'] == $_POST['conf-password']) {
                $auth = new CreateAuthor();
                $message = $auth->getMessage();
            } else {
                $message = "Your passwords didn't match";
            }
            break;
        case 'delete-author':
            $conn->dbDelete('author', 'username', $_POST['forDeletion']);
            $message = "Author ". $_POST['forDeletion'] . " Deleted";
            break;
        case 'set-showcase':
            $conn->dbUpdate('setup', 'article_id', $_POST['showcaseSelected'] , 'layout', 'setup');
            break;
    }

}

$setup = $conn->dbSelect('setup', 'layout', 'setup');


?>

<div class="cwiki-admin">
    <img class="ci-portrait" src="images/sig-background-p.png">
    <img class="ci-landscape" src="images/sig-background.png">

    <div class="cwiki-body c-gen-body">
        <div class="cwiki-text c-gen-text back-trans fc-white">
            <?php echo $message ?>
            <br>


            <!--Selects from all non-superusers-->
            <p class="fc-beta h-text">Delete an author</p>
            <select name="authorSelected" form="authorSelect">
                <?php
                $authorNames = $conn->dbSelect('author', 'superuser', false);

                foreach ($authorNames as $auth) {
                    echo "<option value=" . $auth['username'] . ">" . $auth['username'] . "</option>";
                }
                ?>
            </select>

            <form method="post" id="authorSelect">
                <input type="submit" value="Select">
            </form>


            <?php if (isset($_POST['authorSelected'])) { ?>
                <p class="fc-beta h-text">You've selected
                    <?php echo $_POST['authorSelected']; ?>
                    for deletion

                <form method="post">
                    <input type="hidden" name="action" value="delete-author">
                    <input type="hidden" name="forDeletion" value="<?php echo $_POST['authorSelected']?>">
                    <input type="submit" name="Delete" value="Delete">
                </form>



                <?php
            } /*End */ ?>


            <!--Create and Edit an Author-->
            <p class="fc-beta h-text">Create an Author</p>

            <form method="post">

                <p>Username</p>
                <input class="textbox" type="text" name="new-username" value="">

                <p>Name</p>
                <input class="textbox" type="text" name="new-name" value="">

                <p>Email</p>
                <input class="textbox" type="text" name="new-email" value="">

                <p>Phone Number</p>
                <input class="textbox" type="text" name="new-phone" value="">

                <p>Password</p>
                <input class="textbox" type="password" name="new-password" value="">

                <p>Confirm Password</p>
                <input class="textbox" type="password" name="conf-password" value="">
                <br>
                <input type="hidden" name="action" value="update-author">
                <input type="submit" name="" value="Save">

            </form>



            <!--Set Showcase-->
            <p class="fc-beta h-text">Pick a Showcase</p>
            <select name="showcaseSelected" form="showcaseSelect">
                <?php
                $articleNames = $conn->dbSelect('article', 'display_bool', true);


                foreach ($articleNames as $arts) {
                    echo "<option value=" . $arts['article_id'] . ">" . $arts['title'] . "</option>";
                }
                ?>
            </select>

            <!--Select button for Showcase-->
            <form method="post" id="showcaseSelect">
                <input type="hidden" name="action" value="set-showcase">
                <input type="submit" name="" value="Set Showcase">
            </form>


            <?php
            $showcaseID = $setup['0']['article_id'];
            $article = $conn->dbSelect('article', 'article_id', $showcaseID);

            if (isset($article['0']['title'])) { ?>
                <p class="fc-beta h-text">The current showcase is</p>
                    <?php echo $article['0']['title']; ?>
                <?php
            } /*End */ ?>

            <!--Toggles-->
            <form method="post" id="showcaseSelect">
                <input type="hidden" name="action" value="set-showcase">
                <input type="submit" name="" value="Set Showcase">
            </form>



        </div>
    </div>
</div>
