<!DOCTYPE html>
<html lang="en" role="main">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Masonry Layout PHP</title>
    <meta name="description" content="Masonry Grid Layout with PHP" />
    <meta name="keywords" content="grid items, masonry, php" />
    <meta name="author" content="Shadab" />

    <script type="text/javascript" src="libraries/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="libraries/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="libraries/masonry/masonry.pkgd.min.js"></script>
    <!-- <script type="text/javascript" src="libraries/bootstrap/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="js/scripts.js"></script>

    <link rel="stylesheet" href="libraries/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>

    <div class="container-fluid">
        <div class="loader-container">
            <div class="loader"></div>
        </div>

        <?php
        $json_link_web = 'https://content.xynie.com/feed/fashion-section.json';

        $fetch_json_data = @file_get_contents($json_link_web);
        $json_data = json_decode($fetch_json_data);
        if (!empty($json_data) && is_array($json_data)) {
            echo '<div class="row masonry-container">';
            $view_count_array = array_column_custom($json_data, 'viewCount');
            arsort($view_count_array);
            $counter = 0;
            foreach ($view_count_array as $key => $value) {
                if (!isset($json_data[$key])) {
                    continue;
                }

                $article_data = $json_data[$key];
                $image_data = '';
                if ($counter % 2 == 0) {
                    $image_data = isset($article_data->image) ? $article_data->image : '';
                } else {
                    $image_data = isset($article_data->wideImage) ? $article_data->wideImage : '';
                }
                if (isset($image_data->url)) {
                    $title = isset($article_data->title) ? $article_data->title : '';
                    $link = isset($article_data->path) ? $article_data->path : '';

                    echo '<div class="col-xs-6 col-md-2 col-sm-4 item">';
                    echo '<div class="thumbnail">';
                    echo '<div class="image-container">';
                    echo '<a title="' . $title . '" href="http://www.pinkvilla.com' . $link  . '" target="_blank" rel="noreferrer">';
                    echo '<img alt="' . $title . '" src="' . $image_data->url . '">';
                    echo '<div class="image-middle-text">';
                    echo '<div class="text-oepn">Open</div>';
                    echo '</div>'; // Closed image-middle-text div.
                    echo '</a>'; // Closed image-container div link
                    echo '<div class="image-bottom-left-text">';
                    echo '<a title="pinkvilla.com" href="http://www.pinkvilla.com" target="_blank" rel="noreferrer">';
                    echo '<div class="text-sitename"><span class="glyphicon glyphicon-arrow-up"></span> pinkvilla.com</div>';
                    echo '</a>';
                    echo '</div>'; // Closed image-middle-text div.
                    echo '</div>'; // Closed thumbnail-img div.
                    echo '<div class="caption">';
                    echo '<p><a href="http://www.pinkvilla.com' . $link  . '" target="_blank" rel="noreferrer">' . $title . '</a><p>';
                    echo '</div>';  // Closed caption div.
                    echo '</div>';  // Closed thumbnail div.
                    echo '</div>';  // Closed bootstrap column div.
                    $counter++;
                }
            }

            echo '<div>';
        }
        
        function array_column_custom(array $input, $columnKey, $indexKey = null) {
            $result = array();
            foreach ($input as $subArray) {
                $subArray = is_object($subArray) ? (array) $subArray : $subArray;
                if (!is_array($subArray)) {
                    continue;
                } elseif (is_null($indexKey) && array_key_exists($columnKey, $subArray)) {
                    $result[] = $subArray[$columnKey];
                } elseif (array_key_exists($indexKey, $subArray)) {
                    if (is_null($columnKey)) {
                        $result[$subArray[$indexKey]] = $subArray;
                    } elseif (array_key_exists($columnKey, $subArray)) {
                        $result[$subArray[$indexKey]] = $subArray[$columnKey];
                    }
                }
            }
            return $result;
        }

        ?>
    </div>
</body>
</html>