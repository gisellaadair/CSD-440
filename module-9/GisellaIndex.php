<?php /** GisellaIndex.php: Module 9 navigation for Gisella Adair. */ ?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Gisella Adair | Favorite Movies</title>
<style>body{font:16px/1.5 system-ui;margin:0;background:#f2f5fa;color:#24324b}header{background:#18385e;color:white;padding:2rem}main{max-width:900px;margin:2rem auto;padding:0 1rem}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1rem}article,.note{background:white;padding:1.2rem;border-radius:9px;box-shadow:0 2px 12px #172b4d18}a{color:#135a98;font-weight:650}:focus-visible{outline:3px solid orange}.note{border-left:4px solid #135a98}</style></head>
<body><header><h1>Gisella Adair’s Favorite Movies</h1><p>Module 9 movie database</p></header><main>
<p class="note">For a new database, create the table and populate it before searching. Dropping the table deletes all records.</p><h2>Pages and Module 8 scripts</h2><div class="grid">
<article><h3>Search movies</h3><p>Search by title, director, or genre.</p><a href="GisellaQuery.php">Search records</a></article>
<article><h3>Add a movie</h3><p>Save a new favorite movie.</p><a href="GisellaForms.php">Open form</a></article>
<article><h3>All movies</h3><p>Original complete listing.</p><a href="GisellaQueryTable.php">View all records</a></article>
<article><h3>Create table</h3><p>Set up favorite_movies.</p><a href="GisellaCreateTable.php">Create table</a></article>
<article><h3>Populate table</h3><p>Add five original sample records.</p><a href="GisellaPopulateTable.php">Populate table</a></article>
<article><h3>Drop table</h3><p>Delete the table and records.</p><a href="GisellaDropTable.php">Drop table</a></article>
</div></main></body></html>
