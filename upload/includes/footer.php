	</tr>
			</tbody>
			</table>
			</td>
			<td class="rightmargin"></td>
		</tr>
		<tr>
			<td class="leftmargin"></td>
			<td class="botnav"><img alt="" src="images/container_bl.gif" /></td>
			<td class="middlemargin">
			<img alt="" src="images/middlemargin_b.gif" /></td>
			<td class="botcontent"><img alt="" src="images/container_br.gif" /></td>
			<td class="rightmargin"></td>
		</tr>
	</tbody>
	</table>
	<br />
	<center><font color="#FFFFFF">
	<b>Next Turn: </b> <span id="nextTurnCountdown">00:00</span>

	<script type="text/javascript">
		function updateCountdown() {
			var now = new Date();
			var minutes = now.getMinutes();
			var seconds = now.getSeconds();

			// Calculate next turn (either the half-hour or hour mark)
			var nextTurnMinutes = (minutes < 30) ? 30 : 60;
			var countdownMinutes = nextTurnMinutes - minutes - 1;
			var countdownSeconds = 60 - seconds;

			// Display time in two-digit format
			countdownMinutes = countdownMinutes < 10 ? '0' + countdownMinutes : countdownMinutes;
			countdownSeconds = countdownSeconds < 10 ? '0' + countdownSeconds : countdownSeconds;

			document.getElementById('nextTurnCountdown').innerHTML = countdownMinutes + ":" + countdownSeconds;
		}

		// Update the countdown every second
		setInterval(updateCountdown, 1000);
	</script>
	</font>

</center>

</body>

</html>
