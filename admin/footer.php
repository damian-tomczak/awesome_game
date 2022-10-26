            </tr>
            <tr id="footer">
                <td colspan="3">
                    <p>
                        <?php echo "&copy; 2022" . ((date('Y') != "2022") ? ("-" . date('Y')) : ("")) . " " .$_SERVER['HTTP_HOST'] ?>
                    </p>
                    <p>
                        <?php
                            $indexNumber = '162601';
                            $groupNumber = 'IV';
                            echo 'Made by student Damian Tomczak index: '.$indexNumber.' group: '.$groupNumber;
                        ?>
                    </p>
                </td>
            </tr>
        </table>
    </body>
</html>