<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel') 
<img 
src="{{ asset('/assets/img/dashboard_logo.png')}}" 
class="logo" alt="Laravel Logo">
@else 
<img 
src="{{ asset('/assets/img/dashboard_logo.png')}}" 
{{-- src="https://rabmotlicensing.com/public/assets/img/dashboard_logo.png"  --}}
class="logo" alt="Rabmot Licensing Agency" 
width="1200px" height="120px">
@endif
</a>
</td>
</tr>
