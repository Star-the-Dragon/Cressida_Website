<table border="0" width="900" cellpadding="5" cellpaccing="0" align="center" class="feedback-mes">
	<td width="150" cellpadding="5" valign="top" align="right">
		<h2>скидки, акции и новинки!</h2>
		<p>поделись идеей!</p>
	</td>
	<td width="150" cellpadding="5" valign="middle" align="left">
		<button class="feedback-button" onclick="openFeedbackForm()">Написать отзыв</button>
		<div class="modal" id="feedback-modal">
			<div class="modal-content">
				<span class="close" onclick="closeFeedbackForm()">&times;</span>
				<h2>Обратная связь</h2>
				<div class="contact-form">
					<form action="/Php/send_message.php" method="POST">
						<input type="text" name="name" placeholder="Как к Вам обращаться" required>
						<input type="email" name="email" placeholder="Ваш Email" required>
						<textarea name="message" placeholder="Ваше сообщение" rows="4" required></textarea>
						<button type="submit" class="submit-btn">Отправить</button>
					</form>
				</div>
			</div>
		</div>
	</td>
</table>