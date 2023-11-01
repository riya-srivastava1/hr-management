function changeItemsPerPage(selectElement) {
    const selectedValue = selectElement.value;
    const currentUrl = new URL(window.location.href);
    currentUrl.searchParams.set('itemsPerPage', selectedValue);
    window.location.href = currentUrl.href;
}
