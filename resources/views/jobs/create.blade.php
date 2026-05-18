<x-layout>
  <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
    <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>

    <!-- Form Start -->
    <form method="POST" action="{{ route('jobs.store') }}" enctype="multipart/form-data">
      @csrf

      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Job Info</h2>

      <!-- Job Title -->
      <x-inputs.text id="title" name="title" label="Job Title" placeholder="Software Engineer" />

      <!-- Job Description -->
      <x-inputs.text-area id="description" name="description" label="Job Description"
        placeholder="We are looking for a skilled software engineer to join our team..." />

      <!-- Annual Salary -->
      <x-inputs.text id="salary" name="salary" label="Annual Salary" type="number" placeholder="90000" />

      <!-- Requirements -->
      <x-inputs.text-area id="requirements" name="requirements" label="Requirements"
        placeholder="Bachelor's degree in Computer Science" />

      <!-- Benefits -->
      <x-inputs.text-area id="benefits" name="benefits" label="Benefits"
        placeholder="Health insurance, 401k, paid time off" />

      <!-- Tags -->
      <x-inputs.text id="tags" name="tags" label="Tags (comma-separated)"
        placeholder="development, coding, java, python" />

      <!-- Job Type -->
      <x-inputs.select id="job_type" name="job_type" label="Job Type" :options="['Full-Time' => 'Full-Time', 'Part-Time' => 'Part-Time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']" value="{{ old('job_type') }}" />

      <!-- Remote -->

      <x-inputs.select id="remote" name="remote" label="Remote" :options="[0 => 'No', 1 => 'Yes']" />

      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Company Info</h2>

      <!-- Address -->
      <x-inputs.text id="address" name="address" label="Address" placeholder="123 Main St" />

      <!-- City -->
      <x-inputs.text id="city" name="city" label="City" placeholder="Albany" />

      <!-- State -->
      <x-inputs.text id="state" name="state" label="State" placeholder="NY" />

      <!-- ZIP Code -->
      <x-inputs.text id="zipcode" name="zipcode" label="ZIP Code" placeholder="12203" />

      <!-- Company Name -->
      <x-inputs.text id="company_name" name="company_name" label="Company Name" placeholder="Enter Company name" />

      <!-- Company Description -->
      <x-inputs.text-area id="company_description" name="company_description" label="Company Description"
        placeholder="We are a leading tech company specializing in innovative solutions..." />

      <!-- Company Website -->
      <x-inputs.text id="company_website" name="company_website" label="Company Website" type="url"
        placeholder="https://www.example.com" />

      <!-- Contact Phone -->
      <x-inputs.text id="contact_phone" name="contact_phone" label="Contact Phone" placeholder="555-123-4567" />

      <!-- Contact Email -->
      <x-inputs.text id="contact_email" name="contact_email" label="Contact Email" type="email"
        placeholder="email@example.com" />

      <!-- Company Logo -->
      <x-inputs.file id="company_logo" name="company_logo" label="Company Logo" />

      <!-- Submit Button -->
      <button type="submit"
        class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
        Save
      </button>
    </form>
    <!-- Form End -->

  </div>
</x-layout>