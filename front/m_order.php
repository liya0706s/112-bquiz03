<div id='select'>
    <h3 class="ct">線上訂票</h3>
    <div class="order">
        <div>
            <label>電影：</label>
            <select name="movie" id="movie">
            </select>
        </div>
        <div>
            <label>日期：</label>
            <select name="date" id="date"></select>
        </div>
        <div>
            <label>場次</label>
            <select name="session" id="session"></select>
        </div>
        <div>
            <button onclick="$('#select').hide();$('#booking').show()">確定</button>
            <button>重置</button>
        </div>
    </div>
</div>

<style>
    #room {
        background-image: url('./icon/03D04.png');
        background-position: center;
        background-repeat: none;
        width: 540px;
        height: 370px;
        margin: auto;
    }
</style>
<div id="booking" style='display:none'>
    <div id="room"></div>
    <div id="info">

        <button onclick="$('#select').show();$('#booking').hide()">上一步</button>
        <button>訂購</button>
    </div>
</div>








<script>
    let url = new URL(window.location.href)

    getMovies();

    $("#movie").on("change", function() {
        getDates($("#movie").val())
    })

    $("#date").on("change", function() {
        getSessions($("#movie").val(), $("#date").val())
    })

    function getMovies() {
        $.get("./api/get_movies.php", (movies) => {
            $("#movie").html(movies);
            if (url.searchParams.has('id')) {
                $(`#movie option[value='${url.searchParams.get('id')}']`).prop('selected', true);
            }
            getDates($("#movie").val())
        })
    }

    function getDates(id) {
        $.get("./api/get_dates.php", {
            id
        }, (dates) => {
            $("#date").html(dates);
            let movie = $("#movie").val()
            let date = $("#date").val()
            getSessions(movie, date)
        })
    }

    function getSessions(movie, date) {
        $.get("./api/get_sessions.php", {
            movie,
            date
        }, (sessions) => {
            $("#session").html(sessions);
        })
    }
</script>