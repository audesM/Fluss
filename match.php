<?php
// Récupération des données du formulaire
$projectSkills = array_map('trim', explode(',', $_POST['skills']));
$projectBudget = (int) $_POST['budget'];

// Liste fictive de freelances
$freelancers = [
    [
        'name' => 'Alice',
        'skills' => ['HTML', 'CSS', 'JavaScript', 'PHP'],
        'rate' => 120
    ],
    [
        'name' => 'Bob',
        'skills' => ['Python', 'HTML'],
        'rate' => 100
    ],
    [
        'name' => 'Charlie',
        'skills' => ['HTML', 'CSS', 'JavaScript'],
        'rate' => 180
    ]
];

// Fonctions de matching
function hasRequiredSkills($projectSkills, $freelancerSkills) {
    foreach ($projectSkills as $skill) {
        if (!in_array($skill, $freelancerSkills)) {
            return false;
        }
    }
    return true;
}

function isBudgetCompatible($projectBudget, $freelancerRate) {
    return $freelancerRate <= $projectBudget;
}

function matchFreelancers($projectSkills, $projectBudget, $freelancers) {
    $matched = [];
    foreach ($freelancers as $freelancer) {
        if (hasRequiredSkills($projectSkills, $freelancer['skills']) &&
            isBudgetCompatible($projectBudget, $freelancer['rate'])) {
            $matched[] = $freelancer;
        }
    }
    return $matched;
}

// Matching
$matches = matchFreelancers($projectSkills, $projectBudget, $freelancers);

// Affichage
echo "<h2>Résultats du Matching</h2>";
if (count($matches) > 0) {
    foreach ($matches as $freelancer) {
        echo "<p><strong>{$freelancer['name']}</strong> est un bon match (Tarif : {$freelancer['rate']}€)</p>";
    }
} else {
    echo "<p>Aucun freelance ne correspond à ton projet pour le moment.</p>";
}

echo '<p><a href="index.html">← Revenir</a></p>';
?>
