<div class="popup popup--forget hidden">
	<div class="popup__wall"></div>

	<div class="popup__content">

		<div class="popup__head">
			<div class="popup__close">
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.99926 7.99993L14.8713 2.12784C14.9874 1.99234 15.048 1.81804 15.0411 1.63977C15.0343 1.46149 14.9604 1.29239 14.8342 1.16624C14.7081 1.04009 14.5389 0.966185 14.3607 0.959299C14.1824 0.952413 14.0081 1.01305 13.8726 1.12909L8.00051 7.00118L2.12843 1.12201C1.99504 0.988629 1.81414 0.913696 1.62551 0.913696C1.43688 0.913696 1.25598 0.988629 1.12259 1.12201C0.989211 1.25539 0.914278 1.4363 0.914278 1.62493C0.914278 1.81356 0.989211 1.99446 1.12259 2.12784L7.00176 7.99993L1.12259 13.872C1.04844 13.9355 0.988221 14.0137 0.945705 14.1015C0.903188 14.1894 0.879296 14.2851 0.875528 14.3827C0.87176 14.4802 0.888197 14.5775 0.923808 14.6684C0.959419 14.7593 1.01344 14.8419 1.08247 14.9109C1.1515 14.9799 1.23405 15.0339 1.32495 15.0695C1.41584 15.1052 1.51312 15.1216 1.61067 15.1178C1.70822 15.1141 1.80394 15.0902 1.89182 15.0477C1.9797 15.0051 2.05784 14.9449 2.12134 14.8708L8.00051 8.99868L13.8726 14.8708C14.0081 14.9868 14.1824 15.0474 14.3607 15.0406C14.5389 15.0337 14.7081 14.9598 14.8342 14.8336C14.9604 14.7075 15.0343 14.5384 15.0411 14.3601C15.048 14.1818 14.9874 14.0075 14.8713 13.872L8.99926 7.99993Z"
						  fill="#005DFF"/>
				</svg>
			</div>
			<div class="popup__title">
				Восстановление пароля
			</div>

			<div class="popup__switch">
				<div class="popup__switch-item popup__switch-item-left popup__switch-item--active">По номеру телефона
				</div>

				<div class="popup__switch-choice">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="1" y="1" width="22" height="22" rx="11" fill="#93B6FF"/>
						<rect x="1" y="1" width="22" height="22" rx="11" stroke="white" stroke-width="2"/>
					</svg>
				</div>

				<div class="popup__switch-item popup__switch-item-right ">По эл. почте</div>

			</div>
			<div class="popup__text">
				Введите свой номер телефона <br> на который мы отправим код подтверждения
			</div>
		</div>
		<div class="popup__main">
			<form class="popup__form popup__form--phone">
				<div class="popup__form-title">
					Ваш номер телефона
				</div>


				<!-- unknown -->

				<div class="phone-wrapper">
					<input placeholder="Номер телефона" type="tel" class="phone-input">
					<div class="info-popup">
						<div class="info-popup__wrapper">
							<div class="info-popup__sign">
								<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path d="M8.99996 17.3333C4.40496 17.3333 0.666626 13.595 0.666626 8.99998C0.666626 4.40498 4.40496 0.666645 8.99996 0.666645C13.595 0.666645 17.3333 4.40498 17.3333 8.99998C17.3333 13.595 13.595 17.3333 8.99996 17.3333ZM9.83329 4.83331H8.16663V9.83331H9.83329V4.83331ZM9.83329 11.5H8.16663V13.1666H9.83329V11.5Z"
										  fill="#FF3232"/>
								</svg>
							</div>
							<div class="info-popup__text">
								Извините, пользователь с таким номером телефона не зарегистрирован. Проверьте
								правильность ввода номера.
							</div>
						</div>
					</div>
				</div>


				<div class="popup__wait">
					<div class="popup__wait-time">
						Повторно через

						<span class="popup__wait-num">
                                20
                            </span>
						сек
					</div>
					<div class="popup__wait-repeat">
						Отправить повторно
					</div>
				</div>


				<div class="grey-border-button grey-border-button--unactive">
					Отправить sms
				</div>

				<input type="text" placeholder="Код из SMS" class="popup__code">

				<div class="popup__send-code blue-button">
					<svg width="10" height="9" viewBox="0 0 10 9" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M9.64018 0.731804C10.0645 1.08537 10.1218 1.71593 9.76822 2.14021L4.76822 8.14021C4.58836 8.35605 4.32599 8.48627 4.04531 8.499C3.76464 8.51173 3.49156 8.4058 3.29289 8.20713L0.292893 5.20713C-0.0976311 4.81661 -0.0976311 4.18344 0.292893 3.79292C0.683417 3.40239 1.31658 3.40239 1.70711 3.79292L3.9328 6.01861L8.23178 0.859841C8.58534 0.435564 9.21591 0.37824 9.64018 0.731804Z"
							  fill="white"/>
					</svg>

				</div>

				<div class="popup__success">
					<svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M16.1402 7.7318C16.5645 8.08537 16.6218 8.71593 16.2682 9.14021L11.2682 15.1402C11.0884 15.356 10.826 15.4863 10.5453 15.499C10.2646 15.5117 9.99156 15.4058 9.79289 15.2071L6.79289 12.2071C6.40237 11.8166 6.40237 11.1834 6.79289 10.7929C7.18342 10.4024 7.81658 10.4024 8.20711 10.7929L10.4328 13.0186L14.7318 7.85984C15.0853 7.43556 15.7159 7.37824 16.1402 7.7318Z"
							  fill="white"/>
						<path d="M11.5 21C17.0228 21 21.5 16.5228 21.5 11C21.5 5.47715 17.0228 1 11.5 1C5.97715 1 1.5 5.47715 1.5 11C1.5 16.5228 5.97715 21 11.5 21Z"
							  stroke="white" stroke-width="2"/>
					</svg>

					Успешно

				</div>
			</form>

			<form class="popup__form popup__form--mail">
				<div class="popup__form-title">
					Адрес эл. почты
				</div>

				<div class="popup__wait">
				</div>
				<!-- unknown -->
				<div class="phone-wrapper">
					<input placeholder="e-mail" type="text" class="email-input">
					<div class="info-popup">
						<div class="info-popup__wrapper">
							<div class="info-popup__sign">
								<svg width="18" height="18" viewBox="0 0 18 18" fill="none"
									 xmlns="http://www.w3.org/2000/svg">
									<path d="M8.99996 17.3333C4.40496 17.3333 0.666626 13.595 0.666626 8.99998C0.666626 4.40498 4.40496 0.666645 8.99996 0.666645C13.595 0.666645 17.3333 4.40498 17.3333 8.99998C17.3333 13.595 13.595 17.3333 8.99996 17.3333ZM9.83329 4.83331H8.16663V9.83331H9.83329V4.83331ZM9.83329 11.5H8.16663V13.1666H9.83329V11.5Z"
										  fill="#FF3232"/>
								</svg>
							</div>
							<div class="info-popup__text">
								Извините, пользователь с таким почтовым адресом не зарегистрирован. Проверьте
								правильность ввода почты.
							</div>
						</div>
					</div>
				</div>

				<div class="grey-border-button grey-border-button--unactive">
					Отправить письмо
				</div>

				<input type="text" placeholder="Код из SMS" class="popup__code">


				<div class="popup__success">
					<svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M16.1402 7.7318C16.5645 8.08537 16.6218 8.71593 16.2682 9.14021L11.2682 15.1402C11.0884 15.356 10.826 15.4863 10.5453 15.499C10.2646 15.5117 9.99156 15.4058 9.79289 15.2071L6.79289 12.2071C6.40237 11.8166 6.40237 11.1834 6.79289 10.7929C7.18342 10.4024 7.81658 10.4024 8.20711 10.7929L10.4328 13.0186L14.7318 7.85984C15.0853 7.43556 15.7159 7.37824 16.1402 7.7318Z"
							  fill="white"/>
						<path d="M11.5 21C17.0228 21 21.5 16.5228 21.5 11C21.5 5.47715 17.0228 1 11.5 1C5.97715 1 1.5 5.47715 1.5 11C1.5 16.5228 5.97715 21 11.5 21Z"
							  stroke="white" stroke-width="2"/>
					</svg>

					Отправлено

				</div>
			</form>
		</div>

		<div class="popup__bottom">
			<div class="new-pass-button blue-button blue-button--unactive">
				Обновить пароль
			</div>

			<div class="popup__bottom-b">
				<div class="text-button to-login">
					Войти
				</div>

				<div class="text-button to-registration">
					Зарегистрироваться
				</div>
			</div>
		</div>
	</div>
</div>
