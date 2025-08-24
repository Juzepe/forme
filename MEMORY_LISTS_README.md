# Memory Lists Functionality

This feature allows users to create lists of items and test their memory by recalling them in the correct order.

## Features

- **Create Memory Lists**: Users can create lists with a title, description, and multiple items
- **View Lists**: Browse all created memory lists
- **Edit Lists**: Modify existing lists and their items
- **Memory Testing**: Study a list and then test recall accuracy
- **Score Tracking**: Get detailed results showing correct/incorrect answers and overall score

## How It Works

### 1. Creating a List
- Navigate to Memory Lists → Create New List
- Enter a title and optional description
- Add items one by one (order matters!)
- Save the list

### 2. Studying the List
- View your list to review the items
- Take time to memorize the content and order
- Click "Test Memory" when ready

### 3. Taking the Test
- The test shows numbered input fields for each item
- Enter what you remember for each position
- Submit to see your results

### 4. Reviewing Results
- See your overall score percentage
- Review which items you got correct/incorrect
- Compare your answers with the expected content
- Option to retry the test or return to the list

## Database Structure

- **memory_lists**: Stores list metadata (title, description, user_id)
- **memory_list_items**: Stores individual items with position for ordering

## Routes

- `GET /memory-lists` - View all lists
- `GET /memory-lists/create` - Create new list form
- `POST /memory-lists` - Store new list
- `GET /memory-lists/{id}` - View specific list
- `GET /memory-lists/{id}/edit` - Edit list form
- `PUT /memory-lists/{id}` - Update list
- `DELETE /memory-lists/{id}` - Delete list
- `GET /memory-lists/{id}/test` - Start memory test
- `POST /memory-lists/{id}/check-test` - Submit test answers

## Testing

Run the memory list tests with:
```bash
sail test tests/Feature/MemoryListTest.php
```

## Usage Tips

- Start with short lists (3-5 items) to build confidence
- Use descriptive, memorable content for items
- Take your time studying before testing
- Review incorrect answers to improve memory
- Practice regularly to enhance memory skills
