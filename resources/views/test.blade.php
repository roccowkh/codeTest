<!DOCTYPE html>
<html>
<body>
	<h2>Current conversion rate is {{$rate}}</h2>
    <h2>Yesterday converstion rate is {{$yesterdayRate}}</h2>
    <h3>The rate change for {{$percent}}%</h3>
        <form action="record" method="POST">
        @csrf
        Enter the amount of USD you want to convert: 
        <input type="text" name="usd" required="required" /> <br/>
        <input type="submit" value="Convert"/>
        </form>
        <label>Inputted {{$usd}} USD</label><br>
        <label>Result is {{$value}} HKD</label>
    </body>

</html>
