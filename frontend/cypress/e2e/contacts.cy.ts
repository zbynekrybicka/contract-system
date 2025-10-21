describe('Contacts', () => {
  beforeEach(() => {
    cy.visit('http://localhost:5173')
    cy.get("input[name=email]").type("test@demo.cz")
    cy.get("input[name=password]").type("password123")
    cy.intercept('POST', '/login').as('login');
    cy.get("button").click()
    cy.wait(10000)
    cy.wait('@login')
  })

  it('New contact', () => {
    cy.get("nav [href='/contacts']").click()

    cy.get(".button-new-contact").click()

    cy.get(".new-contact label input[name=firstName]").should("exist")
    cy.get(".new-contact input[name=firstName]").type("Radek")

    cy.get(".new-contact label input[name=middleName]").should("exist")
    cy.get(".new-contact input[name=middleName]").type("ethanol")

    cy.get(".new-contact label input[name=lastName]").should("exist")
    cy.get(".new-contact input[name=lastName").type("Brezina")

    cy.get(".new-contact label select[name=dialNumber]").should("exist")
    cy.get(".new-contact select[name=dialNumber]").select("420")

    cy.get(".new-contact label input[name=phoneNumber]").should("exist")
    cy.get(".new-contact input[name=phoneNumber]").type("542123059")

    cy.get(".new-contact label input[name=email]").should("exist")
    cy.get(".new-contact input[name=email]").type("radek.brezina@gmail.com")

    cy.intercept('POST', '/contact').as('postContact');
    cy.get(".new-contact button.post-contact").click()
    cy.wait(10000)
    cy.wait('@postContact')
    cy.get('.new-contact').should('not.exist')
  })

  it('Edit contact', () => {
    cy.get("nav [href='/contacts']").click()
    cy.get(".contact-list .contact-list.item").click()

    cy.get(".edit-contact input").focus()
    cy.get(".edit-contact input").focus()
    cy.get(".edit-contact input").focus()

    cy.get(".edit-contact select").focus()
    cy.get(".edit-contact input").focus()
    cy.get(".edit-contact input").focus()

    cy.get(".edit-contact button").click()
  })
})