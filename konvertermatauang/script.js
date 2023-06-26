document.getElementById('currency-form').addEventListener('submit', function(e) {
    e.preventDefault();
  
    var amount = parseFloat(document.getElementById('amount').value);
    var fromCurrency = document.getElementById('from').value;
    var toCurrency = document.getElementById('to').value;
  
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'convert.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          var result = amount.toFixed(2) + ' ' + fromCurrency + ' = ' + response.convertedAmount.toFixed(2) + ' ' + toCurrency;
          document.getElementById('result').textContent = result;
        } else {
          document.getElementById('result').textContent = response.message;
        }
      }
    };
    xhr.send('amount=' + encodeURIComponent(amount) + '&from=' + encodeURIComponent(fromCurrency) + '&to=' + encodeURIComponent(toCurrency));
  });
  