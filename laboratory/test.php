<?php
include_once("includes/includes.php");
Session::checkSession();
//
$menu_active = "note-creation";
include_once(filePath . "/head.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Header, Footer, and Scrollable Main with PDF Printing</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: white;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            padding-top: 60px;
            padding-bottom: 40px; /* Adjust based on the footer height */
            overflow-y: scroll; /* Enable vertical scrolling for the main content */
            height: auto; /* Take the full height of the viewport */
            /* height: 100vh; Take the full height of the viewport */
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        #printPDF {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
 <!-- Your scrollable content goes here -->
 <table>
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Generate 8 rows and 2 columns
            for ($row = 1; $row <= 8; $row++) {
                echo '<tr>';
                echo '<td>Row ' . $row . ', Column 1</td>';
                echo '<td>Row ' . $row . ', Column 2</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</header>

    <main>
        <!-- Your scrollable content goes here -->
        <table class="table" width="100%">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Test Parameters</th>
                    <th>Testing Protocol </th>
                    <th>Specification</th>
                    <th>Unit</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody><tr style="background:#C8E6C9,text-transform: uppercase;">
            <td colspan="6" style="text-transform: uppercase;display:none;"><b></b></td>
            </tr>
                <tr>
                    <td class="ff">1</td>
                    <td class="ff">Description/Physical Observation</td>
                    <td class="ff">-</td>
                    <td style="" class="ff">Shall be free from lumps, unpowdered jaggery pieces, unpleasant odour and extraneous matter </td>
                    <td class="ff">-</td>
                    <td class="ff"> free from lumps, unpowdered jaggery pieces, unpleasant odour and extraneous matter </td>
                </tr>
                 
                <tr>
                    <td class="ff">2</td>
                    <td class="ff">Moisture</td>
                    <td class="ff">IS 16072 : 2012</td>
                    <td style="" class="ff">max-5.0</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">2.28</td>
                </tr>
                 
                <tr>
                    <td class="ff">3</td>
                    <td class="ff">Total Ash </td>
                    <td class="ff">IS 14433 : 2022</td>
                    <td style="" class="ff">max-5.0</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">2.36</td>
                </tr>
                 
                <tr>
                    <td class="ff">4</td>
                    <td class="ff">Acid Insoluble Ash</td>
                    <td class="ff">IS 14433 : 2022</td>
                    <td style="" class="ff">max-0.1</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">0.061</td>
                </tr>
                 
                <tr>
                    <td class="ff">5</td>
                    <td class="ff">Fat</td>
                    <td class="ff">FSSAI manual of Methods of Analysis of Foods Cereal and cereal products Fssai 03.039:2022 pg No.117-118:2022</td>
                    <td style="" class="ff">min-10</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">10.53</td>
                </tr>
                 
                <tr>
                    <td class="ff">6</td>
                    <td class="ff">Crude Fibre (on dry basis)</td>
                    <td class="ff">IS 10226 : Part 1 : 1982</td>
                    <td style="" class="ff">max-3.5</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">0.68</td>
                </tr>
                 
                <tr>
                    <td class="ff">7</td>
                    <td class="ff">Protein(N x 6.25) </td>
                    <td class="ff">IS 7219 : 1973</td>
                    <td style="" class="ff">min-14.0</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">14.39</td>
                </tr>
                 
                <tr>
                    <td class="ff">8</td>
                    <td class="ff"> Total Carbohydrate</td>
                    <td class="ff"> IS 1656:2022</td>
                    <td style="" class="ff">min--</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">70.44</td>
                </tr>
                 
                <tr>
                    <td class="ff">9</td>
                    <td class="ff">Energy</td>
                    <td class="ff">SOP NO : 04/Issue no.02/Issue Date 02.08 : 2007</td>
                    <td style="" class="ff">min-400.0</td>
                    <td class="ff">Kcal/100g</td>
                    <td class="ff">434.09</td>
                </tr>
                 
                <tr>
                    <td class="ff">10</td>
                    <td class="ff">Amylase activity( Qualitative)</td>
                    <td class="ff">SOPNO:04/Issue no.02/Issue Date: 02.08.2007</td>
                    <td style="" class="ff">Present </td>
                    <td class="ff">-</td>
                    <td class="ff">Present </td>
                </tr>
                 
                <tr>
                    <td class="ff">11</td>
                    <td class="ff">Total Aflatoxin (B1, B2, G1&amp; G2)$</td>
                    <td class="ff">SOP NO:140/Issue No-01/Issue Date-28.10:2017</td>
                    <td style="" class="ff">max-15</td>
                    <td class="ff">µg/kg</td>
                    <td class="ff">BDL(LOD≥3ppb)</td>
                </tr>
                 
                <tr>
                    <td class="ff">12</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">13</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">14</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">15</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">16</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">17</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">18</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">19</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">20</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">21</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">22</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">23</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">1</td>
                    <td class="ff">Description/Physical Observation</td>
                    <td class="ff">-</td>
                    <td style="" class="ff">Shall be free from lumps, unpowdered jaggery pieces, unpleasant odour and extraneous matter </td>
                    <td class="ff">-</td>
                    <td class="ff"> free from lumps, unpowdered jaggery pieces, unpleasant odour and extraneous matter </td>
                </tr>
                 
                <tr>
                    <td class="ff">2</td>
                    <td class="ff">Moisture</td>
                    <td class="ff">IS 16072 : 2012</td>
                    <td style="" class="ff">max-5.0</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">2.28</td>
                </tr>
                 
                <tr>
                    <td class="ff">3</td>
                    <td class="ff">Total Ash </td>
                    <td class="ff">IS 14433 : 2022</td>
                    <td style="" class="ff">max-5.0</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">2.36</td>
                </tr>
                 
                <tr>
                    <td class="ff">4</td>
                    <td class="ff">Acid Insoluble Ash</td>
                    <td class="ff">IS 14433 : 2022</td>
                    <td style="" class="ff">max-0.1</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">0.061</td>
                </tr>
                 
                <tr>
                    <td class="ff">5</td>
                    <td class="ff">Fat</td>
                    <td class="ff">FSSAI manual of Methods of Analysis of Foods Cereal and cereal products Fssai 03.039:2022 pg No.117-118:2022</td>
                    <td style="" class="ff">min-10</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">10.53</td>
                </tr>
                 
                <tr>
                    <td class="ff">6</td>
                    <td class="ff">Crude Fibre (on dry basis)</td>
                    <td class="ff">IS 10226 : Part 1 : 1982</td>
                    <td style="" class="ff">max-3.5</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">0.68</td>
                </tr>
                 
                <tr>
                    <td class="ff">7</td>
                    <td class="ff">Protein(N x 6.25) </td>
                    <td class="ff">IS 7219 : 1973</td>
                    <td style="" class="ff">min-14.0</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">14.39</td>
                </tr>
                 
                <tr>
                    <td class="ff">8</td>
                    <td class="ff"> Total Carbohydrate</td>
                    <td class="ff"> IS 1656:2022</td>
                    <td style="" class="ff">min--</td>
                    <td class="ff">% by mass</td>
                    <td class="ff">70.44</td>
                </tr>
                 
                <tr>
                    <td class="ff">9</td>
                    <td class="ff">Energy</td>
                    <td class="ff">SOP NO : 04/Issue no.02/Issue Date 02.08 : 2007</td>
                    <td style="" class="ff">min-400.0</td>
                    <td class="ff">Kcal/100g</td>
                    <td class="ff">434.09</td>
                </tr>
                 
                <tr>
                    <td class="ff">10</td>
                    <td class="ff">Amylase activity( Qualitative)</td>
                    <td class="ff">SOPNO:04/Issue no.02/Issue Date: 02.08.2007</td>
                    <td style="" class="ff">Present </td>
                    <td class="ff">-</td>
                    <td class="ff">Present </td>
                </tr>
                 
                <tr>
                    <td class="ff">11</td>
                    <td class="ff">Total Aflatoxin (B1, B2, G1&amp; G2)$</td>
                    <td class="ff">SOP NO:140/Issue No-01/Issue Date-28.10:2017</td>
                    <td style="" class="ff">max-15</td>
                    <td class="ff">µg/kg</td>
                    <td class="ff">BDL(LOD≥3ppb)</td>
                </tr>
                 
                <tr>
                    <td class="ff">12</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">13</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">14</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">15</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">16</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">17</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">18</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">19</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">20</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">21</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                <tr>
                    <td class="ff">22</td>
                    <td class="ff">Escherichia coli</td>
                    <td class="ff">IS 5887 (Part 1):1976</td>
                    <td style="" class="ff">Absent in 0.1 g</td>
                    <td class="ff">cfu/g</td>
                    <td class="ff">&lt;10</td>
                </tr>
                                    
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </main>

    <footer>
        <p>Fixed Footer</p>
    </footer>

    <!-- Button to trigger PDF generation -->
    <?php include_once(filePath . "/js.php"); ?>

</body>
</html>
