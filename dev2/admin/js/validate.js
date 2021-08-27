function auto_address_update(form){
		form.first_name_billing.value = form.first_name.value;
		form.last_name_billing.value = form.last_name.value;
		form.address_billing.value = form.address.value;
		form.address2_billing.value = form.address2.value;
		form.city_billing.value = form.town.value;
		form.state_billing.value = form.state.value;
		form.zip_billing.value = form.zip.value;
		form.country_billing.value = form.country.value;
	}

