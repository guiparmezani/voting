<?php // content="text/plain; charset=utf-8"

		function generateGraph($datay){
				
				require_once ('../jpgraph/src/jpgraph.php');
				require_once ('../jpgraph/src/jpgraph_bar.php');
				
				if(file_exists("graph/file.jpg")){
					unlink("graph/file.jpg");
				}

				// Create the graph. These two calls are always required
				$graph = new Graph(300,400,'auto');
				$graph->SetScale("textlin");
				
				//$theme_class="DefaultTheme";
				//$graph->SetTheme(new $theme_class());
				
				// set major and minor tick positions manually
				$graph->yaxis->SetTickPositions(array(0,1,5,10,15,20,25,30,35,40,45,50), array(2,3,4));
				$graph->SetBox(false);
				
				//$graph->ygrid->SetColor('gray');
				$graph->ygrid->SetFill(false);
				$graph->xaxis->SetTickLabels(array('A','B','C','D','E'));
				$graph->yaxis->HideLine(false);
				$graph->yaxis->HideTicks(false,false);
				
				// Create the bar plots
				$b1plot = new BarPlot($datay);
				
				// ...and add it to the graPH
				$graph->Add($b1plot);
				
				$b1plot->value->Show();
				$b1plot->SetColor("blue");
				$b1plot->SetWidth(45);
				
				// Display the graph
				$graph->Stroke("graph/file.jpg");
				
		}
				 
				?>