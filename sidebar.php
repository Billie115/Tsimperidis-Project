<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    #body {
        margin-top: 3vh;
        text-align: center;
        max-width: 300px;
        height: auto;
        border: 1px solid black;
        border-radius: 5px;
    }

    #sidebar {
        width: auto;
        height: auto;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #logo {
        margin-top: 5px;
        margin-left: 15%;
        display: flex;
        justify-self: center;
        align-self: center;
        border-radius: 10px;
        box-shadow: 2px 3px 2px 2px gray;
    }

    #expand-btn {
        border-radius: 10px;
        padding: 8px;
        margin-left: 8px;
        background-color: white;
    }

    .sidebar_items {
        text-decoration: none;
        margin-top: 10px;
        border: 1px solid black;
        width: 80%;
        text-decoration: none;
        /* margin-left: 10px; */
        padding: 10px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .sidebar_items a {
        font-size: 20px;
        color: #143349;
    }

    .sidebar_items:hover {
        cursor: pointer;
        transition: all 0.8ms;
        transform: scale(0.9);
    }
</style>

<script>
    function sidebar_expand() {
        const sidebar_elements = document.getElementsByClassName('sidebar_items');
        const sidebar = document.getElementById('body');
        const logo= document.getElementById("logo")
        if (sidebar.style.width === "300px") {
            sidebar.style.width = "100px";
            logo.style.width="80px";
            for (let item of sidebar_elements) {
                item.style.visibility = 'hidden';
            }
        } else {
            sidebar.style.width = "300px";
            for (let item of sidebar_elements) {
                item.style.visibility = "visible";
            }
        }
    }
</script>

<div id="body">
    <div style="display: flex; align-items: center;">
        <img src="./Images/Totoya_Cars.png" width="200px" id="logo">
        <!-- <h3 style="font-size:20px; margin-left:2px;">Totoya Cars</h3> -->
        <button id="expand-btn" onclick="sidebar_expand()">
            <i class="material-icons">menu_open</i></button>
    </div>
    <aside id="sidebar">
        <div class="sidebar_items">
            <i class="material-icons">home</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Αρχική Σελίδα</a>
        </div>

        <div class="sidebar_items">
            <i class="material-icons">business_center</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Εταιρίες</a>
        </div>

        <div class="sidebar_items">
            <i class="material-icons">directions_car</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Αυτοκίνητα</a>
        </div>

        <div class="sidebar_items">
            <i class="material-icons">people</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Πελάτες</a>
        </div>

        <div class="sidebar_items">
            <i class="material-icons">badge</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Υπάλληλοι</a>
        </div>

        <div class="sidebar_items">
            <i class="material-icons">handshake</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Πωλήσεις</a>
        </div>

        <div class="sidebar_items">
            <i class="material-icons">car_repair</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Συντήριση</a>
        </div>
        <br><br>
        <div class="sidebar_items" style="margin-bottom: 10px;">
            <i class="material-icons">logout</i>
            <a href="/sub_sites/dashboard.php" style="text-decoration: none; ">Έξοδος</a>
        </div>
    </aside>
</div>