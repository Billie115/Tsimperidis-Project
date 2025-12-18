<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>
<style>
    #body {
        backdrop-filter: blur(10px);
        margin-top: 10px;
        border: 1px solid black;
        border-radius: 5px;
        width: 300px;
        height: 650px;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    #sidebar {
        width: auto;
        height: auto;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        gap: 7px;
    }

    .sidebar_items {
        border: 1px solid black;
        width: 200px;
        text-decoration: none;
        margin-left: 10px;
        margin-right: 10px;
        padding: 10px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        align-self: center;
        gap: 7px;
        cursor: pointer;
    }

    .sidebar_items span {
        color: black;
        font-size: 20px;
        text-align: center;
    }

    .sidebar_items:hover {
        transform: scale(0.9);
        transition: all;
    }

    #logo {
        width: 200px;
        height: 150px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.28);
        border-radius: 8px;
        margin: 6px;
        margin-left: 20px;

    }

    #expand-btn {
        position: absolute;
        top: 20px;
        right: -20px;
        z-index: 1000;
        cursor: pointer;
        padding: 10px;
        border: 1px solid black;
    }

    @media (max-width:760px) {
        #logo {
            display: none;
        }

        .sidebar_items {
            display: none;
        }

        #body {
            backdrop-filter: blur(10px);
            z-index: 100;
            width: 30px;
            height: 30px;
            border: none;
        }

        #expand-btn {
            position: fixed;
            top: 2px;
            left: 2px;
            z-index: 1000;
            cursor: pointer;
        }
    }
</style>

<script>
    let sidebarOpen = true; // track state

    function sidebar_expand() {
        const sidebar_body = document.getElementById('body');
        const sidebar_items = document.getElementsByClassName('sidebar_items');
        const exp_btn = document.getElementById('expand-btn');
        const logo = document.getElementById('logo');

        if (sidebarOpen) {
            // COLLAPSE
            sidebar_body.style.width = '30px';
            sidebar_body.style.height = '30px';
            sidebar_body.style.border = 'none';
            logo.style.display = 'none';

            for (let item of sidebar_items) {
                item.style.display = 'none';
            }

            sidebarOpen = false;
        } else {
            // EXPAND
            sidebar_body.style.width = 'fit-content';
            sidebar_body.style.height = '650px';
            sidebar_body.style.border = '1px solid black';
            logo.style.display = 'block';

            for (let item of sidebar_items) {
                item.style.display = 'flex';
            }

            sidebarOpen = true;
        }
    }
</script>


<body>
    <div id="body">
        <div style="display: flex; align-items: center;">
            <img src="../Images/Totoya_Cars.png" id="logo">
            <div id="expand-btn" onclick="sidebar_expand()">
                <i class="material-icons">menu_open</i>
            </div>
        </div>
        <aside id="sidebar">
            <div class="sidebar_items" onclick="location.href='home.php'">
                <i class="material-icons">home</i>
                <span>Αρχική Σελίδα</span>
            </div>

            <div class="sidebar_items" onclick="location.href='etairies.php'">
                <i class="material-icons">business_center</i>
                <span>Εταιρίες</span>
            </div>

            <div class="sidebar_items" onclick="location.href='autokinhta.php'">
                <i class="material-icons">directions_car</i>
                <span>Αυτοκίνητα</span>
            </div>
            <div class="sidebar_items" onclick="location.href='montela.php'">
                <i class="material-icons">directions_car</i>
                <span>Μοντέλα</span>
            </div>

            <div class="sidebar_items" onclick="location.href='pelates.php'">
                <i class="material-icons">people</i>
                <span>Πελάτες</span>
            </div>

            <div class="sidebar_items" onclick="location.href='upallhloi.php'">
                <i class="material-icons">badge</i>
                <span>Υπάλληλοι</span>
            </div>

            <div class="sidebar_items" onclick="location.href='pwlhseis.php'">
                <i class="material-icons">handshake</i>
                <span>Πωλήσεις</span>
            </div>

            <div class="sidebar_items" onclick="location.href='sunthrish.php'">
                <i class="material-icons">car_repair</i>
                <span>Συντήρηση</span>
            </div>

            <div class="sidebar_items" onclick="location.href='../index.php'" style="margin-top: 10px;">
                <i class="material-icons">logout</i>
                <span>Έξοδος</span>
            </div>

        </aside>
    </div>
</body>

</html>