<?php

/**
 * REPARATEUR DE STOCKAGE LARAVEL - PRODUCTION
 * Version 4.0 (Relative Symlinks)
 */

header('Content-Type: text/html; charset=utf-8');

$root = realpath(__DIR__ . '/..');
$publicStorage = __DIR__ . '/storage';
$appStorage = $root . '/storage/app/public';

// IMPORTANT: On utilise un chemin RELATIF pour plus de compatibilité sur LWS
$relativeTarget = '../storage/app/public';

echo "<h2>Diagnostic du Stockage Laravel (Relative Mode)</h2>";
echo "<b>Chemin Public :</b> <code>" . $publicStorage . "</code><br>";
echo "<b>Cible Relative :</b> <code>" . $relativeTarget . "</code><br><br>";

// 1. Détection du type de lien actuel
if (file_exists($publicStorage)) {
    if (is_link($publicStorage)) {
        $actualTarget = readlink($publicStorage);
        echo "ℹ️ Un lien existe déjà. Cible actuelle : <code>$actualTarget</code><br>";

        if ($actualTarget === $relativeTarget) {
            echo "✨ Le lien est déjà RELATIF et CORRECT.<br>";
        } else {
            echo "⚠️ Le lien est ABSOLU ou INCORRECT. <a href='?action=fix'>[CLIQUER ICI POUR RÉPARER EN MODE RELATIF]</a><br>";
        }
    } else {
        echo "⚠️ <code>public/storage</code> est un DOSSIER RÉEL.<br>";
        echo "<a href='?action=fix'>[CLIQUER ICI POUR RÉPARER AUTOMATIQUEMENT]</a><br>";
    }
} else {
    echo "ℹ️ <code>storage</code> n'existe pas dans public. <a href='?action=fix'>[CRÉER LE LIEN RELATIF]</a><br>";
}

// 2. Action de réparation
if (isset($_GET['action']) && $_GET['action'] == 'fix') {
    echo "<hr><h3>Réparation avec liens RELATIFS...</h3>";

    // Nettoyage
    if (file_exists($publicStorage)) {
        if (!is_link($publicStorage)) {
            $backup = $publicStorage . '_old_' . date('His');
            rename($publicStorage, $backup);
            echo "✅ Dossier physique renommé en <code>" . basename($backup) . "</code><br>";
        } else {
            unlink($publicStorage);
            echo "✅ Ancien lien supprimé.<br>";
        }
    }

    // Création du lien RELATIF
    // On doit se placer dans le dossier public pour que le lien soit correct
    if (symlink($relativeTarget, $publicStorage)) {
        echo "<h3 style='color:green;'>🎉 SUCCÈS !</h3>";
        echo "Le lien symbolique relatif a été créé. <br>";
        echo "Essayez de charger une image. Si ça ne marche toujours pas, votre hébergeur interdit probablement totalement les liens symboliques.";
    } else {
        echo "<h3 style='color:red;'>❌ ÉCHEC</h3>";
        echo "Impossible de créer le lien. La fonction <code>symlink</code> est probablement désactivée sur votre compte LWS.";
    }
}
