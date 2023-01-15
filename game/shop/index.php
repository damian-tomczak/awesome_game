</div>
<div class="separator shop watchword">
    Customize your experience!
</div>
<div class="content">
    <div class="menu">
        <nav>
        <ul>
            <li>Item 1
            <ul>
                <li>Item 1
                <ul>
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                </ul>
                </li>
                <li>Item 2</li>
                <li>Item 3</li>
            </ul>
            </li>
            <li>Item 2
            <ul>
                <li>Item 1
                <ul>
                    <li>Item 1
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2</li>
                        <li>Item 3</li>
                    </ul>
                    </li>
                    <li>Item 2
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2</li>
                        <li>Item 3</li>
                    </ul>
                    </li>
                    <li>Item 3
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2</li>
                        <li>Item 3</li>
                    </ul>
                    </li>
                </ul>
                </li>
                <li>Item 2</li>
                <li>Item 3</li>
            </ul>
            </li>
            <li>Item 3
            <ul>
                <li>Item 1</li>
                <li>Item 2
                <ul>
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3
                    <ul>
                        <li>Item 1</li>
                        <li>Item 2
                        <ul>
                            <li>Item 1</li>
                            <li>Item 2</li>
                            <li>Item 3
                            <ul>
                                <li>Item 1
                                <ul>
                                    <li>Item 1</li>
                                    <li>Item 2</li>
                                    <li>Item 3</li>
                                </ul>
                                </li>
                                <li>Item 2
                                <ul>
                                    <li>Item 1</li>
                                    <li>Item 2
                                    <ul>
                                        <li>Item 1</li>
                                        <li>Item 2</li>
                                        <li>Item 3
                                        <ul>
                                            <li>Item 1</li>
                                            <li>Item 2</li>
                                            <li>Item 3</li>
                                            <li>Item 4</li>
                                            <li>Item 5</li>
                                            <li>Item 6</li>
                                            <li>Item 7</li>
                                            <li>Item 8</li>
                                            <li>Item 9</li>
                                        </ul>
                                        </li>
                                    </ul>
                                    </li>
                                    <li>Item 3</li>
                                </ul>
                                </li>
                                <li>Item 3</li>
                            </ul>
                            </li>
                        </ul>
                        </li>
                        <li>Item 3</li>
                    </ul>
                    </li>
                </ul>
                </li>
                <li>Item 3</li>
            </ul>
            </li>
        </ul>
        </nav>
    </div>
    <div>
        <?php
            $categories = Category::get_list();
            echo json_encode($categories);
            $dict = array();
            echo '<hr>';
            foreach ($categories as $key=>$value) {
                $categories[$key] = array($value, false);
            }
            echo json_encode($categories);
            $completed = false;
            for ($i = 0, $counter = 0;
                ((!$completed) && ($i < sizeof($categories))) &&
                ($counter <= 50); $i++, $counter++) {
                if (!$completed && $i == 0) {
                    $completed = true;
                }
                if ($categories[$i][1] == false) {
                    $completed = false;
                }
                $parent_instantiated = false;
                echo $categories[$i][0]->name . '<br>';
                echo 'current parent: ' . $categories[$i][0]->parent . '<br>';
                foreach ($categories as $row) {
                    if (($row[0]->id == $categories[$i][0]->parent) && $row[1]) {
                        $parent_instantiated = true;
                    }
                }
                if ($parent_instantiated) {
                    echo 'parent<br>';
                    echo '<hr>';
                } else {
                    echo 'no<br>';
                }
                if ((($categories[$i][0]->parent == null) || ($parent_instantiated)) &&
                    $categories[$i][1] == false) {
                    $categories[$i][1] = true;
                    echo '<nav>';
                    echo '<ul>';
                    echo '<li>' . $categories[$i][0]->name . '</li>';
                    echo '</ul>';
                    echo '</nav>';
                }
                if ($i == (sizeof($categories) - 1)) {
                    $i = 0;
                }
            }
        ?>
    </div>
    <div>
        Someting dummy.
    </div>
</div>
<!-- <div class="content">
    <p>Your current balance: <span id="amount"><?php //echo getMoney(); ?>$</span></p>
    <p>Selected color: <span id="color"></span></p>
    <div class="shop">
        <div class="slides" style="background-color:red"></div>
        <div class="slides" style="background-color:yellow"></div>
        <div class="slides" style="background-color:green"></div>
        <div class="slides" style="background-color:blue"></div>
    </div>
    <div class="buttons">
        <button onclick="plusDivs(-1)">&#10094;</button>
        <button id="select"></button>
        <button onclick="plusDivs(1)">&#10095;</button>
    </div>
</div> -->
