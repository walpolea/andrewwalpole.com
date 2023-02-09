export function formatDate(date) {
  const dateOptions = {
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  
  const formattedPublishDate = new Date(date).toLocaleDateString(
    "en-US",
    dateOptions
  );

  return formattedPublishDate;
}