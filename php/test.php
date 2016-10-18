 <?php

// $htmlBody = <<<END
// <form method="GET">
//   <div>
//     Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
//   </div>
//   <div>
//     Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
//   </div>
//   <input type="submit" value="Search">
// </form>
// END;

// // This code will execute if the user entered a search query in the form
// // and submitted the form. Otherwise, the page displays the form above.
// if ($_GET['q'] && $_GET['maxResults']) {
//   // Call set_include_path() as needed to point to your client library.
// require_once '../google/src/Google/autoload.php';
// require_once '../google/src/Google/Client.php';
// require_once '../google/src/Google/Service/YouTube.php';

//   /*
//    * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
//    * Google Developers Console <https://console.developers.google.com/>
//    * Please ensure that you have enabled the YouTube Data API for your project.
//    */
//   $DEVELOPER_KEY = 'AIzaSyA6jJD4brngNsLvKbblig2bBhuF9uGwjW4';

//   $client = new Google_Client();
//   $client->setDeveloperKey($DEVELOPER_KEY);

//   // Define an object that will be used to make all API requests.
//   $youtube = new Google_Service_YouTube($client);

//   try {
//     // Call the search.list method to retrieve results matching the specified
//     // query term.
//     $searchResponse = $youtube->search->listSearch('id,snippet', array(
//       'q' => $_GET['q'],
//       'maxResults' => $_GET['maxResults'],
//       // 'channelId' =>    'UC3yA8nDwraeOfnYfBWun83g'
//     ));

//     $videos = ''; 
//     $channels = '';
//     $playlists = '';

//     // Add each result to the appropriate list, and then display the lists of
//     // matching videos, channels, and playlists.
//     foreach ($searchResponse['items'] as $searchResult) {
//       switch ($searchResult['id']['kind']) {
//         case 'youtube#video':
//           $videos .= sprintf('<li>%s (%s)</li>',
//               $searchResult['snippet']['title'], $searchResult['id']['videoId']);
//           break;
//         case 'youtube#channel':
//           $channels .= sprintf('<li>%s (%s)</li>',
//               $searchResult['snippet']['title'], $searchResult['id']['channelId']['videoCategoryId']);
//           break;
//         case 'youtube#playlist':
//           $playlists .= sprintf('<li>%s (%s)</li>',
//               $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
//           break;
//       }
//     }

//     $htmlBody .= <<<END
//     <h3>Videos</h3>
//     <ul>$videos</ul>
//     <h3>Channels</h3>
//     <ul>$channels</ul>
//     <h3>Playlists</h3>
//     <ul>$playlists</ul>
// END;
//   } catch (Google_Service_Exception $e) {
//     $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
//       htmlspecialchars($e->getMessage()));
//   } catch (Google_Exception $e) {
//     $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
//       htmlspecialchars($e->getMessage()));
//   }
// }

//       function print_r_nice($array, $exit = true){
//         echo "<pre>".print_r($array, true)."</pre>";
//         if($exit) exit;
//       }
 ?>

<!--  <!doctype html>
//  <html>
//    <head>
//      <title>YouTube Search</title>
//    </head>
//    <body> -->
    <?php  
//     $DEVELOPER_KEY = 'AIzaSyA6jJD4brngNsLvKbblig2bBhuF9uGwjW4';
//     $catID = 14;
//     // https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoCategoryId=17&key=$DEVELOPER_KEY";
//       $videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&videoCategoryId=17&key=AIzaSyA6jJD4brngNsLvKbblig2bBhuF9uGwjW4");
//       // json_encode($videoTitle, options, depth)
//       print_r_nice($videoTitle);
      
//       // $json = json_decode($videoTitle, true);
//       // echo $json;
//       // if ($videoTitle) {
//       //   // $json = json_decode($videoTitle, true);
//       //   // echo $json;  
//       //   echo $videoTitle;
//       // }
//     $url = "https://www.youtube.com/watch?v=bvYUq6Ox0Hc";
//     $html =  new SimpleXmlElement($url, null, true);

//     $content = $html->xpath("//a[@class='yt-uix-sessionlink']");
// echo $content;
    $url = "https://www.youtube.com/watch?v=bvYUq6Ox0Hc";
    // $html =  new SimpleXmlElement($url, null, true);

    // $content = $html->xpath("//div[@id='watch-description']");
    // echo "<br /><br />".$content;
    $content = file_get_contents($url);
    $first_step = explode( '<div id="watch-description">' , $content ); // So you will get two array element
    $second_step = explode("</div>" , $first_step[0] ); // "1" depends, if you have more elements with this id (theoretical) 
    echo $second_step;
// echo $second_step[0]; // You will get the first element with the content within the DIV :)
//     ?>
 <!-- </body>


  </html> -->