<?php
// Připojení k databázi
include 'session_open.php';

// Načtení dotazu z GET parametru
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!empty($query)) {
    // SQL dotaz pro vyhledávání článků
    $articleSql = "SELECT DISTINCT A.ID, A.Title AS Name, GROUP_CONCAT(DISTINCT CONCAT(U.FirstName, ' ', U.LastName) SEPARATOR ', ') AS Author, 'article' AS Type 
                   FROM `RSP_ARTICLE` A
                   JOIN `RSP_ARTICLE_ROLE` R ON A.ID = R.Article
                   JOIN `RSP_USER` U ON R.Person = U.ID
                   WHERE hasAccess(".$myID.", A.ID) AND (A.Title LIKE :query 
                        OR EXISTS(select Person from `RSP_ARTICLE_ROLE` R WHERE A.ID = R.Article AND Active_to is null AND CONCAT(U.FirstName, ' ', U.LastName) LIKE :query))
                   GROUP BY A.ID";

    $stmt = $conn->prepare($articleSql);
    $stmt->execute([':query' => "%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $results = [];
}

// Generování HTML návrhů
if ($results) {
    foreach ($results as $result) {
        echo '<div class="suggestion-item" onclick="gotoarticle(' . htmlspecialchars($result['ID']) . ')">';
        echo '<strong>' . htmlspecialchars($result['Name']) . '</strong>';
        echo '<br><small>' . htmlspecialchars($result['Author']) . '</small>';
        echo '</div>';
    }
} else {
    echo '<div class="suggestion-item">Žádné výsledky.</div>';
}
?>
