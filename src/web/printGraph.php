<?php 
include ('jpgraph/jpgraph.php');
include ('jpgraph/jpgraph_line.php');


$test_attendu = array(11,7,4,0);
$test_reel = array(11,8,6,2);


// Setup the graph
$graph = new Graph(500,450);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Burn down Chart');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels(array('Initial','Sprint 1','Sprint 2','Sprint 3'));
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($test_attendu);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('résultat attendu');

// Create the second line
$p2 = new LinePlot($test_reel);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('résultat reel');


$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();
?>