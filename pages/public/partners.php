<?php

include_once '../../includes/global/session.php';

notLogguedSecurity("../../index.php");


include_once $includesPublic . 'header.php';

include_once $assetsShared . 'icons/icons.php';
include_once "navbar/header.php";

$user = $_SESSION['user_info'];

$niveau = isset($_GET['niveau']) && is_array($_GET['niveau']) ? $_GET['niveau'] : [];
$postes = isset($_GET['poste']) && is_array($_GET['poste']) ? $_GET['poste'] : [];

$sql = "SELECT id, prenom, nom, pseudo, niveau, poste, localisation, pfp FROM utilisateur WHERE id != :id";
$params = [':id' => $user['id']];

if (!empty($niveau)) {
    $niveau = array_filter($niveau, function($n) {
        return in_array($n, ['0', '1', '2', '3'], true);
    });

    if (!empty($niveau)) {
        $placeholders = [];
        foreach ($niveau as $index => $val) {
            $key = ":niveau$index";
            $placeholders[] = $key;
            $params[$key] = $val;
        }
        $sql .= " AND niveau IN (" . implode(', ', $placeholders) . ")";
    }
}

if (!empty($postes)) {
    // Filtrer uniquement les valeurs valides 0 à 4
    $postes = array_filter($postes, function($p) {
        return in_array($p, ['0', '1', '2', '3', '4'], true);
    });

    if (!empty($postes)) {
        $placeholders = [];
        foreach ($postes as $index => $val) {
            $key = ":poste$index";
            $placeholders[] = $key;
            $params[$key] = $val;
        }
        $sql .= " AND poste IN (" . implode(', ', $placeholders) . ")";
    }
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="d-flex">
    <?php
        if (isset($_SESSION)) {
            $_SESSION['current_page'] = 'settings';
        }
        include_once "navbar/navbar.php";
    ?>    

    <div class="container-fluid px-0" id="content">                
        <div id="partners-page">
            <section class="text-white py-5" style="background-color: #3a3a3a;">
                <div class="text-center">
                    <h2 class="fs-1 fw-bold text-center text-white mb-4">Filtrez vos coéquipiers</h2>
                    <p class="fs-6 text-cetner text-white mb-0">Connectez-vous avec d'autres personnes et profitez d’un match fait pour vous !</p>
                </div>
            </section>
            
            <div class="container py-4">
                <h2 class="fs-2 fw-bold">Filtres</h1>
                <div class="accordion" id="accordion-filter1">
                    <form class="d-flex flex-row gap-4 align-items-start" method="GET" action="partners">

                        <!-- Niveau -->
                        <div style="width: 180px;">
                            <h5>Niveau</h5>
                            <fieldset>
                                <div class="btn-group-vertical w-100" data-bs-toggle="buttons">
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="niveau[]" id="lvl1" value="0" autocomplete="off"> Débutant
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="niveau[]" id="lvl2" value="1" autocomplete="off"> Intermédiaire
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="niveau[]" id="lvl3" value="2" autocomplete="off"> Avancé
                                    </label>
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="niveau[]" id="anylvl" value="3" autocomplete="off"> Tous
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Position -->
                        <div style="width: 180px;">
                            <h5>Poste</h5>
                            <fieldset>
                                <div class="btn-group-vertical w-100" data-bs-toggle="buttons">
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="poste[]" id="pos1" value="0" autocomplete="off"> Meneur de jeu
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="poste[]" id="pos2" value="1" autocomplete="off"> Arrière
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="poste[]" id="pos3" value="2" autocomplete="off"> Ailier
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="poste[]" id="pos4" value="3" autocomplete="off"> Ailier fort
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="poste[]" id="pos5" value="4" autocomplete="off"> Pivot
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="poste[]" id="posAll" value="5" autocomplete="off"> Tous
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <button type="submit" class="btn btn-primary">Valider</button>

                    </form>
        
                </div>
            </div>

            <div class="container py-4">
                <h2 class="fw-bold">Coéquipiers</h2>
                <div class="container row g-4">
                    <?php
                        foreach($results as $mate) {
                            echo displayCardUser($mate);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>            
</div>

<?php include_once $includesGlobal . "footer.php"; ?>