<?php
require './../../../../config/config.php';


// Consultas para obtener datos de filtros
$brands = $enlace->query("SELECT * FROM brands")->fetchAll(PDO::FETCH_ASSOC);
$categories = $enlace->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$tiers = $enlace->query("SELECT * FROM tiers")->fetchAll(PDO::FETCH_ASSOC);

$searchTerm = '';
$selectedBrand = '';
$selectedCategory = '';
$selectedTier = '';

// Base de la consulta
$query = "
    SELECT reviews.*, products.product_name, users.username, brands.brand_name, categories.category_name, tiers.tier_name 
    FROM reviews
    JOIN products ON reviews.fk_product_id = products.product_id
    LEFT JOIN users ON reviews.fk_author_id = users.user_id
    LEFT JOIN brands ON products.fk_brand_id = brands.brand_id
    LEFT JOIN product_categories ON products.product_id = product_categories.fk_product_id
    LEFT JOIN categories ON product_categories.fk_category_id = categories.category_id
    LEFT JOIN tiers ON products.fk_tier_id = tiers.tier_id
    WHERE 1=1 LIMIT 5";

$params = [];

// Manejo del filtro de búsqueda
if (isset($_GET['searchbar']) && !empty($_GET['searchbar'])) {
    $searchTerm = $_GET['searchbar'];
    $query .= " AND products.product_name LIKE :searchTerm";
    $params['searchTerm'] = '%' . $searchTerm . '%';
}

// Manejo de otros filtros
if (isset($_GET['brand']) && !empty($_GET['brand'])) {
    $selectedBrand = $_GET['brand'];
    $query .= " AND brands.brand_name = :brand";
    $params['brand'] = $selectedBrand;
}

if (isset($_GET['category']) && !empty($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    $query .= " AND categories.category_name = :category";
    $params['category'] = $selectedCategory;
}

if (isset($_GET['tier']) && !empty($_GET['tier'])) {
    $selectedTier = $_GET['tier'];
    $query .= " AND tiers.tier_name = :tier";
    $params['tier'] = $selectedTier;
}

$consulta = $enlace->prepare($query);
if (!$consulta->execute($params)) {
    die("Query failed: " . print_r($consulta->errorInfo(), true));
}

$reviews = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¿Quiénes Somos?</title>
    <link rel="stylesheet" href="./../../../../public/assets/css/faq.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navBar.php'; ?>
    <main>
        <section id="quienes-somos">
            <h1>¿Quiénes Somos?</h1>

            <section id="nosotros">
                <h2>Nosotros</h2>
                <div class="container mt-3">
                    <p>PSU Gang es un término utilizado para describir un grupo de entusiastas de la tecnología y expertos en fuentes de poder (PSU, por sus siglas en inglés) que comparten conocimientos, opiniones y experiencias sobre fuentes de poder de alta calidad.</p>

                    <p>El PSU Gang se caracteriza por:</p>

                    <ol>
                        <li><strong>Enfoque en la calidad y la precisión:</strong> Buscan fuentes de poder con alta eficiencia, estabilidad y confiabilidad.</li>
                        <li><strong>Análisis detallado:</strong> Realizan pruebas y análisis exhaustivos de las fuentes de poder para evaluar su rendimiento y características.</li>
                        <li><strong>Compartir conocimientos:</strong> Comparten sus hallazgos y opiniones en foros, redes sociales y otros canales para ayudar a otros a elegir fuentes de poder adecuadas.</li>
                        <li><strong>Énfasis en la seguridad:</strong> Destacan la importancia de las protecciones y características de seguridad en las fuentes de poder.</li>
                        <li><strong>Críticas constructivas:</strong> Ofrecen críticas y sugerencias para mejorar las fuentes de poder y promover la innovación en la industria.</li>
                    </ol>

                    <p>El PSU Gang ha ganado reconocimiento en la comunidad de tecnología por su enfoque en la calidad y la precisión, y su compromiso con la educación y la orientación en el ámbito de las fuentes de poder.</p>
                </div>

            </section>

            <section id="faq">
                <h2>FAQ (Preguntas Frecuentes)</h2>

                <div class="faq-item">
                    <button class="faq-question">¿Qué es el PSU Gang?</button>
                    <div class="faq-answer">
                        <p>El PSU Gang es una comunidad de entusiastas de la tecnología especializados en fuentes de poder. Nos enfocamos en compartir conocimientos y opiniones sobre productos de alta calidad en el ámbito de las PSU.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">¿Por qué es importante la calidad de las fuentes de poder?</button>
                    <div class="faq-answer">
                        <p>La calidad de las fuentes de poder es crucial para la estabilidad y seguridad de los componentes del sistema. Fuentes de poder de alta calidad garantizan eficiencia, protecciones adecuadas y una mayor vida útil de los dispositivos.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">¿Cómo puedo unirme a la comunidad PSU Gang?</button>
                    <div class="faq-answer">
                        <p>Puedes unirte a nuestra comunidad a través de nuestras plataformas en línea, donde compartimos análisis, reseñas y noticias sobre fuentes de poder y otros componentes de hardware.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">¿Ofrecen recomendaciones personalizadas para fuentes de poder?</button>
                    <div class="faq-answer">
                        <p>Sí, ofrecemos recomendaciones basadas en las necesidades específicas de tu sistema y tus preferencias. Puedes contactarnos a través de nuestras redes sociales o foros para más información.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">¿Cuál es la diferencia entre una PSU de alta calidad y una de baja calidad?</button>
                    <div class="faq-answer">
                        <p>Las PSUs de alta calidad generalmente tienen mayor eficiencia energética, mejor construcción, más protecciones de seguridad y una mayor estabilidad de voltaje. Las de baja calidad pueden comprometer el rendimiento y la seguridad del sistema.</p>
                    </div>
                </div>
            </section>
            <h1>Productos Destacados</h1>
            <section class="content">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1%">#</th>
                                    <th class="text-center" style="width: 25%">Titulo</th>
                                    <th class="text-center" style="width: 25%">Producto</th>
                                    <th class="text-center" style="width: 25%">Autor</th>
                                    <th class="text-center">Calificación</th>
                                    <th class="text-center" style="width: 25%">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reviews)) : ?>
                                    <?php foreach ($reviews as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo htmlspecialchars($row['review_id']); ?></td>
                                            <td class="text-center"><a href="./../reseñas/reviewDetail.php?review_id=<?php echo htmlspecialchars($row['review_id']); ?>"><?php echo htmlspecialchars($row['title']); ?></a></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['product_name']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['username']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['tier_name']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['date_review']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No hay reseñas disponibles.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <section id="social">
                <style>
                    .social-icon {
                        color: black;
                        transition: color 0.2s;
                        text-decoration: none;
                    }

                    .social-icon:hover {
                        color: #aaaaaa;
                    }
                </style>
                <div>

                </div>
                <div>
                    <h2>Redes Sociales</h2>
                    <a class="social-icon" href="https://www.instagram.com/psugangts/">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                    <a class="social-icon" href="https://psugang.github.io/">
                        <ion-icon name="logo-github"></ion-icon>
                    </a>
                    </a>
                    <a class="social-icon" href="https://www.facebook.com/PSUG4ng">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </div>
                <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

            </section>
            <div>
                       
            

            </div>
        </section>
        </section>
    </main>

    <footer>
        <p>&copy.</p>
    </footer>

    <script src="./../../../../public/assets/js/faq.js"></script>
</body>

</html>