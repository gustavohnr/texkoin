<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col" class="text-uppercase">Rank</th>
            <th scope="col"></th>
            <th scope="col" class="text-uppercase">Nome</th>
            <th scope="col" class="text-uppercase">Texkoins</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $names = ["John Doe", "Jane Smith", "Michael Johnson", "Emma Brown", "David Wilson", "Olivia Davis", "Daniel Taylor", "Sophia Anderson", "Joseph Martinez", "Ava Thompson"];

        for ($i = 1; $i <= 10; $i++) {
            $name = $names[$i - 1];
            $score = rand(0.01, 2);
            $profilePic = "https://picsum.photos/200/200/";

            echo "<tr>
                    <td class='align-middle'>$i</td>
                    <td class='align-middle'><img src='$profilePic' alt='$name' class='profile-img'></td>
                    <td class='align-middle'>$name</td>
                    <td class='align-middle'>$score</td>
                </tr>";
        }
        ?>
    </tbody>
</table>