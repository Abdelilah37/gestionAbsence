<?php
  include('sideBar.php');
  include('session.php');
  if(isset($_GET['cin'])){
    $cin = $_GET['cin'];
    $sql = "SELECT *  FROM stagiaire 
            WHERE cin = ? ";
        $stmt =  $pdo_conn->prepare($sql);
        $stmt -> bindParam(1,$cin);
        $stmt->execute();
        $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);
  }


  $sql = "CALL ShowAbsenceHours(?)";
  $stmt = $pdo_conn->prepare($sql);
  $stmt->bindParam(1, $cin);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $hoursWithJustification = $result['Hours With Justification'];
  $hoursWithoutJustification = $result['Hours Without Justification'];

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ofppt WFS205</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon1.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/avertissement.css">
  <link rel="stylesheet" href="../assets/css/sidebarmenu.css">
  <link rel="stylesheet" href="../assets/css/profileStagiaire.css">
  <link rel="stylesheet" href="../assets/css/calender.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <?php include('sideBarDATA.php')?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="d-none d-md-none d-lg-block">
              <!-- Form -->
              <form action="#">
        
                <div class="input-groupC ">
                  <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                  <span class="input-group-append">
                    <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                      </svg>
                    </button>
                  </span>
                </div>
              </form>
            </ul>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="./sign_out.php" class="btn btn-primary">sign out</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="./index.php" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  body -->
        <div class="container mb-5">
          <div class="position-relative">
            <div class="position-absolute top-0 start-0">
              <p>Stagiaires Listes<span class="text-dark fw-bold py-3"> > Stagiaires Details Page</span></p>
            </div>
            <div class="position-absolute top-0 end-0 w-auto text-end p-1 border border-dark rounded-pill">
              <a class="nav-link text-dark fw-bold" href="./listeStagiaire.php">
                <i>
                  <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </i>
                Retour
              </a>
            </div>
          </div>
        </div>
        <?php include("searchlink.php") ?>
            <div class="card-body shadow-sm p-3 mb-5 rounded-4 text-white ProfileCard">
                  <div class="container">
                              <div class="col-12  ">
                                    <h1 class="text-white"><strong><?php echo $stagiaire['nom'] ?></strong></h1>
                                    <h1 class="text-white"><strong><?php echo $stagiaire['prenom'] ?></strong></h1>
                              </div>

                              <div class="row">
                                    <ul class="list-inline">
                                          <li class="list-inline-item">Cin: <strong><?php echo $stagiaire['cin'] ?></strong></li>
                                          <li class="list-inline-item">Né le: <strong><?php echo $stagiaire['dateNaissance'] ?></strong></li>
                                          <li class="list-inline-item">Annee: <strong><?php echo $stagiaire['Niveau'] ?></strong></li>
                                          <li class="list-inline-item">Groupe: <strong><?php echo $stagiaire['groupe'] ?></strong></li>
                                          <li class="list-inline-item">Telephone: <strong>0<?php echo $stagiaire['NTelephone'] ?></strong></li>
                                    </ul>
                              </div>

                        <div class="row ">
                            
                            <div class="col p-3 mt-1 me-2 rounded-4 Note">
                                <!-- First div -->
                                <h1 class="text-white"><strong><?php echo $stagiaire['noteDisciplinaire'] ?></strong></h1>
                                <h4 class="text-white">la Note Desciplinaire</h4>
                            </div>

                            <div class="col p-3 mt-1 me-2 rounded-4 NoJustifier">
                                <!-- Second div -->
                                    <h1 class="text-white"><strong><?php echo $hoursWithoutJustification?></strong><span>Hr</span></h1>
                                    <h4 class="text-white">heures absent non Justifier</h4>
                            </div>

                            <div class="col p-3 mt-1 me-2 rounded-4 Justifier">
                                <!-- Third div -->
                                <h1 class="text-white"><strong><?php echo $hoursWithJustification?></strong><span>Hr</span></h1>
                                <h4 class="text-white">heures absent justifier</h4>
                            </div>

                        </div>
                  </div>
            </div>
            <div class="row ">
              <!-- calender -->
              <div class="col">
                    <div class="calendar">
                      <div class="header">
                        <div class="month">July 2021</div>
                        <div class="btns">
                          <!-- today -->
                          <div class="btn today">
                            <i class="fas fa-calendar-day"></i>
                          </div>
                          <!-- previous month -->
                          <div class="btn prev">
                            <i class="fas fa-chevron-left"></i>
                          </div>
                          <!-- next month -->
                          <div class="btn next">
                            <i class="fas fa-chevron-right"></i>
                          </div>
                        </div>
                      </div>
                      <div class="weekdays">
                        <div class="day">Dim</div>
                        <div class="day">Lun</div>
                        <div class="day">Ma</div>
                        <div class="day">Mer</div>
                        <div class="day">Jeu</div>
                        <div class="day">Ven</div>
                        <div class="day">Sam</div>
                      </div>
                      <div class="days">
                        <!-- render days with js -->
                      </div>
                    </div>
                </div>
                <!-- avertissement -->
                <div class="col">
                    <div class="table-responsive rounded border border-light shadow-sm">
                      <table class="table">
                        <thead class="bg-gray-2 table-light text-left">
                          <tr>
                            
                            <th class="min-width-150 py-3 px-4 font-weight-medium">
                              Date Avertissement
                            </th>
                            <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Status
                            </th>
                            <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Action
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>01/12/2023</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <p
                                class="py-1 px-3 text-sm font-weight-medium avertissement"
                              >
                                Avertissement
                              </p>
                            </td> 
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>01/12/2023</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <p
                                class="py-1 px-3 text-sm font-weight-medium avertissement"
                              >
                                Avertissement
                              </p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>01/12/2023</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <p
                                class="py-1 px-3 text-sm font-weight-medium avertissement"
                              >
                                Avertissement
                              </p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>

            <!-- table Absence -->
            <div class="row mt-4 ">
              <div class="col-12">
                <div class="card-body">
                  <!-- table -->
                    <div class="table-responsive rounded border border-light shadow-sm">
                      <table class="table table-hover">
                        <thead class="bg-gray-2 table-light text-left">
                          <tr>
                            <th class="min-width-220 py-3 px-4 font-weight-medium">
                              Date Absence
                            </th>
                            <th class="min-width-150 py-3 px-4 font-weight-medium">
                              Nombre Heures
                            </th>
                            <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Justification
                            </th>
                            <th class="min-width-120 py-3 px-4 font-weight-medium">
                              Action
                            </th>
                            
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>23/11/2023</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>5 Hr</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>Aucune</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>03/11/2023</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>5 Hr</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>Aucune</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>30/12/2023</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>10 Hr</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>Certificat Medical</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>01/10/2023</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>2.5 Hr</p>
                            </td>
                            <td class="border-bottom text-dark fw-bold py-3 px-4">
                              <p>Aucune</p>
                            </td>
                            <td class="border-bottom py-3 px-4">
                              <div class="d-flex align-items-center">
                                <button class="btn btn-link text-primary">
                                  <!-- delete -->
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    height="1em"
                                    viewBox="0 0 448 512"
                                  >
                                    <path
                                      d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
              
          
      </div>

        <!-- footer -->
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Copyright By <a href="#" target="_blank" class="pe-1 text-primary text-decoration-underline">WFS205</a> 2023</p>
        </div>
      </div>
    </div>

    
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/listeStagiaires.js"></script>
  <script src="../assets/js/calender.js"></script>
</body>

</html>