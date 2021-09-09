<script>
    export let items;
    export let sum;
    export let old_sum;
    export let periods;
    export let period;
    export let credit_sum;
    export let subscribe_sum;
    export let isAuthorized;

    export function checked() {
        const url = '/ajax/recount.php';
        var formData = new FormData();
        formData.append('period', period);
        formData.append('sum', sum);
        fetch(url, {method: 'POST', body: formData})
            .then(response => {
                const data = response.text();
                data.then((value) => {
                    credit_sum = value;
                });
            });
    }

    export function handleBuy(paymentMethod) {

        const url = '/ajax/addtobasket.php';
        var formData = new FormData();
        var data = {
            'paymentMethod': paymentMethod,
            'items': items,
            'total': {'total_sum': sum, 'total_old_sum': old_sum, 'total_subscribe_sum': subscribe_sum, 'is_credit': periods}
        };
        formData.append('data', JSON.stringify(data));

        fetch(url, {method: 'POST', body: formData})
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            })
            .catch(function (err) {
                console.info(err + " url: " + url);
            });
    }
</script>
<div class="solutions__bottom">
    <div class="container">
        <div class="solutions__bottom_title">
            Итого, в ваше Готовое решение входит:
        </div>
        <div class="solutions__bottom_wrapper">
            <div class="solutions__bottom_left">
                <div class="solutions__bottom_left-left">
                    {#each items as row}
                        {#if row.active}
                            <div class="solutions__bottom_row">
                                <p class="solutions__bottom_row-left">{row.title}</p>
                                <div class="solutions__bottom_row-center">
                                    <span>{row.name1}</span>
                                    <span>{row.name2}</span>
                                </div>
                            </div>
                        {/if}
                    {/each}
                </div>
                <div class="solutions__bottom_left-right">
                    <div class="predloj__present">
                        <div class="present__text">
                            <div class="h5">В подарок:</div>
                            <ul>
                                {#each items[0].gift as row}
                                    <li><span>✓</span> {row}</li>
                                {/each}
                            </ul>
                        </div>
                        <picture>
                            <source type="image/svg" srcset="/upload/images/equipment/podarok.svg">
                            <img src="/upload/images/equipment/podarok.svg" alt="img" loading="lazy">
                        </picture>
                    </div>
                </div>
            </div>

            <div class="solutions__bottom_right">
                <div class="solutions__bottom_column">
                    <div class="solutions__bottom_column-title">
                        Всего
                    </div>
                    {#if old_sum !== sum}
                        <div class="solutions__bottom_column-oldprice">
                            {old_sum} ₽
                        </div>
                    {:else}
                        <div class="solutions__bottom_column-oldprice" style="text-decoration-line: none">
                            &nbsp;
                        </div>
                    {/if}
                    <div class="solutions__bottom_column-newprice">
                        {sum} ₽
                    </div>
                    {#if isAuthorized}
                        <button on:click="{() => handleBuy('card')}"
                                class="solutions__bottom_column-btn grey">
                            купить
                        </button>
                    {:else}
                        <button data-payment="card" class="js-modal js-modal-auth solutions__bottom_column-btn grey">
                            купить
                        </button>
                    {/if}
                </div>
                {#if periods}
                    <div class="solutions__bottom_column">
                        <div class="solutions__bottom_column-title">
                            Рассрочка без процентов
                        </div>
                        <div class="solutions__bottom_column-interest">
                            <p>все проценты<br>
                                за вас платит vincko:
                            </p>
                        </div>
                        <div class="solutions__bottom_column-monthprice js-installment">
                            <div>
                                <select class="installment-period__select js-installment-period" bind:value={period}
                                        on:change={() => checked()} data-price="{sum}">
                                    {#each periods as period}
                                        <option value="{period.UF_MONTHS}">{period.UF_MONTHS} мес.</option>
                                    {/each}
                                </select>
                            </div>
                            <p>по</p>
                            <div class="solutions__bottom_column-price nowrap">
                            <span class="js-installment-price">
                               {credit_sum}
                            </span>
                                ₽
                            </div>
                        </div>
                        {#if isAuthorized}
                            <button on:click="{() => handleBuy('installment')}"
                                    class="solutions__bottom_column-btn green-sber">
                                <svg class="sber-svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M14.3251 3.66502L16.2759 2.2266C14.5616 0.84729 12.3744 0 9.99016 0V0.0199143C7.41905 0.024905 5.07156 1.00551 3.29912 2.61029L3.29065 2.60097C1.26914 4.42621 0.0100175 7.05293 5.95061e-05 9.9749C2.02687e-05 9.97999 0 9.98507 0 9.99012C0 9.9934 1.58444e-06 9.99668 4.7526e-06 9.99995C1.58457e-06 10.0032 0 10.0065 0 10.0098H1.90953e-05C0.00500391 12.581 0.985653 14.9285 2.5905 16.701L2.58127 16.7094C4.40682 18.7312 7.03412 19.9904 9.95667 19.9999L9.97044 20L9.97723 20L9.99015 20V20C12.5665 19.995 14.9184 19.0104 16.6921 17.3997L16.7094 17.4187C18.7192 15.6059 20 12.9458 20 10.0098C20 9.39899 19.9409 8.80786 19.8424 8.21673L17.6946 9.81278V10.0098C17.6946 12.14 16.8239 14.0612 15.4264 15.4461L15.4089 15.4286C14.0296 16.8473 12.1182 17.6946 9.99015 17.6946H9.9817C9.91537 17.6946 9.85347 17.6945 9.79153 17.6921C9.72801 17.6896 9.66446 17.6846 9.59606 17.6749L9.59556 17.6846C7.62825 17.5846 5.86161 16.7414 4.56368 15.4363L4.57144 15.4285C3.17242 14.0492 2.30542 12.1379 2.30542 10.0098C2.30542 9.94231 2.30631 9.87497 2.30808 9.80782C2.31061 9.74543 2.31553 9.68293 2.32513 9.61574L2.31558 9.61525C2.41628 7.6626 3.25932 5.88279 4.56372 4.58359L4.57145 4.59132C5.95076 3.19231 7.8818 2.32531 9.99018 2.32531C10.1281 2.32531 10.2463 2.32531 10.3843 2.34502L10.3856 2.31976C11.8499 2.40838 13.2037 2.88728 14.3251 3.66502ZM19.1133 5.89161C18.7784 5.18225 18.3843 4.5123 17.9114 3.90146L9.99017 9.71426L6.18721 7.33003V10.2069L10.0099 12.6108L19.1133 5.89161Z"
                                          fill="white"></path>
                                </svg>
                                В рассрочку
                            </button>
                        {:else}
                            <button data-payment="installment"
                                    class="js-modal js-modal-auth solutions__bottom_column-btn green-sber">
                                <svg class="sber-svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M14.3251 3.66502L16.2759 2.2266C14.5616 0.84729 12.3744 0 9.99016 0V0.0199143C7.41905 0.024905 5.07156 1.00551 3.29912 2.61029L3.29065 2.60097C1.26914 4.42621 0.0100175 7.05293 5.95061e-05 9.9749C2.02687e-05 9.97999 0 9.98507 0 9.99012C0 9.9934 1.58444e-06 9.99668 4.7526e-06 9.99995C1.58457e-06 10.0032 0 10.0065 0 10.0098H1.90953e-05C0.00500391 12.581 0.985653 14.9285 2.5905 16.701L2.58127 16.7094C4.40682 18.7312 7.03412 19.9904 9.95667 19.9999L9.97044 20L9.97723 20L9.99015 20V20C12.5665 19.995 14.9184 19.0104 16.6921 17.3997L16.7094 17.4187C18.7192 15.6059 20 12.9458 20 10.0098C20 9.39899 19.9409 8.80786 19.8424 8.21673L17.6946 9.81278V10.0098C17.6946 12.14 16.8239 14.0612 15.4264 15.4461L15.4089 15.4286C14.0296 16.8473 12.1182 17.6946 9.99015 17.6946H9.9817C9.91537 17.6946 9.85347 17.6945 9.79153 17.6921C9.72801 17.6896 9.66446 17.6846 9.59606 17.6749L9.59556 17.6846C7.62825 17.5846 5.86161 16.7414 4.56368 15.4363L4.57144 15.4285C3.17242 14.0492 2.30542 12.1379 2.30542 10.0098C2.30542 9.94231 2.30631 9.87497 2.30808 9.80782C2.31061 9.74543 2.31553 9.68293 2.32513 9.61574L2.31558 9.61525C2.41628 7.6626 3.25932 5.88279 4.56372 4.58359L4.57145 4.59132C5.95076 3.19231 7.8818 2.32531 9.99018 2.32531C10.1281 2.32531 10.2463 2.32531 10.3843 2.34502L10.3856 2.31976C11.8499 2.40838 13.2037 2.88728 14.3251 3.66502ZM19.1133 5.89161C18.7784 5.18225 18.3843 4.5123 17.9114 3.90146L9.99017 9.71426L6.18721 7.33003V10.2069L10.0099 12.6108L19.1133 5.89161Z"
                                          fill="white"></path>
                                </svg>
                                В рассрочку
                            </button>
                        {/if}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>
