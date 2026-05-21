<form method="GET" action="{{ route('jobs.search') }}"
  class="mx-5 md:mx-auto space-y-2 md:flex md:items-center md:justify-center md:gap-2 md:space-y-0">
  <input type="text" name="keywords" placeholder="Keywords" class="w-full bg-white border border-gray-300  md:w-72 px-4 py-3 focus:outline-none"
    value="{{ request('keywords') }}" />
  <input type="text" name="location" placeholder="Location" class="w-full bg-white border border-gray-300  md:w-72 px-4 py-3 focus:outline-none"
    value="{{ request('location') }}" />
  <button class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 rounded focus:outline-none">
    <i class="fa fa-search mr-1"></i> Search
  </button>
</form>